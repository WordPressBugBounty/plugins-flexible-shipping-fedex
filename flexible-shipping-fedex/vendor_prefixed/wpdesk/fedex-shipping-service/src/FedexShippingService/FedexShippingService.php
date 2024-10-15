<?php

namespace FedExVendor\WPDesk\FedexShippingService;

use FedExVendor\CageA80\FedEx\RateRequestControlParameters;
use FedExVendor\CageA80\FedEx\Services\Rates\RatesResponse;
use FedExVendor\FedEx\RateService\ComplexType\RateReply;
use FedExVendor\Psr\Log\LoggerInterface;
use FedExVendor\WPDesk\AbstractShipping\Exception\InvalidSettingsException;
use FedExVendor\WPDesk\AbstractShipping\Exception\RateException;
use FedExVendor\WPDesk\AbstractShipping\Exception\UnitConversionException;
use FedExVendor\WPDesk\AbstractShipping\Rate\ShipmentRating;
use FedExVendor\WPDesk\AbstractShipping\Rate\ShipmentRatingImplementation;
use FedExVendor\WPDesk\AbstractShipping\Settings\SettingsValues;
use FedExVendor\WPDesk\AbstractShipping\Shipment\Shipment;
use FedExVendor\WPDesk\AbstractShipping\ShippingService;
use FedExVendor\WPDesk\AbstractShipping\ShippingServiceCapability\CanInsure;
use FedExVendor\WPDesk\AbstractShipping\ShippingServiceCapability\CanPack;
use FedExVendor\WPDesk\AbstractShipping\ShippingServiceCapability\CanRate;
use FedExVendor\WPDesk\AbstractShipping\ShippingServiceCapability\CanTestSettings;
use FedExVendor\WPDesk\AbstractShipping\ShippingServiceCapability\HasSettings;
use FedExVendor\WPDesk\AbstractShipping\Shop\ShopSettings;
use FedExVendor\WPDesk\FedexShippingService\Exception\CurrencySwitcherException;
use FedExVendor\WPDesk\FedexShippingService\FedexApi\ConnectionChecker;
use FedExVendor\WPDesk\FedexShippingService\FedexApi\FedexRateCurrencyFilter;
use FedExVendor\WPDesk\FedexShippingService\FedexApi\FedexRateCustomServicesFilter;
use FedExVendor\WPDesk\FedexShippingService\FedexApi\RestApi\FedexRestApiRateReplyInterpretation;
use FedExVendor\WPDesk\FedexShippingService\FedexApi\RestApi\FedexRestApiRateRequestBuilder;
use FedExVendor\WPDesk\FedexShippingService\FedexApi\Soap\FedexSoapRateReplyInterpretation;
use FedExVendor\WPDesk\FedexShippingService\FedexApi\Soap\FedexSoapRateRequestBuilder;
use FedExVendor\WPDesk\FedexShippingService\FedexApi\Soap\FedexSender;
use FedExVendor\WPDesk\FedexShippingService\FedexApi\Soap\Sender;
/**
 * FedEx main shipping class injected into WooCommerce shipping method.
 *
 * @package WPDesk\FedexShippingService
 */
class FedexShippingService extends ShippingService implements HasSettings, CanRate, CanInsure, CanPack, CanTestSettings
{
    /** Logger.
     *
     * @var LoggerInterface
     */
    private $logger;
    /** Shipping method helper.
     *
     * @var ShopSettings
     */
    private $shop_settings;
    const UNIQUE_ID = 'flexible_shipping_fedex';
    /**
     * Sender.
     *
     * @var Sender
     */
    private $sender;
    /**
     * @var string|null
     */
    private $auth_provider_class;
    /**
     * @var RateRequestControlParameters|null
     */
    protected $rate_request_control_parameters;
    /**
     * FedexShippingService constructor.
     *
     * @param LoggerInterface $logger Logger.
     * @param ShopSettings $helper Helper.
     * @param string|null $auth_provider_class .
     */
    public function __construct(LoggerInterface $logger, ShopSettings $helper, $auth_provider_class = null)
    {
        $this->logger = $logger;
        $this->shop_settings = $helper;
        $this->auth_provider_class = $auth_provider_class;
        $this->rate_request_control_parameters = null;
    }
    public function is_rate_enabled(SettingsValues $settings)
    {
        return \true;
    }
    /**
     * Set logger.
     *
     * @param LoggerInterface $logger Logger.
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    /**
     * Set sender.
     *
     * @param Sender $sender Sender.
     */
    public function set_sender(Sender $sender)
    {
        $this->sender = $sender;
    }
    /**
     * Get sender.
     *
     * @return Sender
     */
    public function get_sender()
    {
        return $this->sender;
    }
    /**
     * Create reply interpretation.
     *
     * @param RateReply $rate_reply .
     * @param ShopSettings $shop_settings .
     * @param SettingsValues $settings .
     *
     * @return FedexSoapRateReplyInterpretation
     */
    protected function create_soap_reply_interpretation(RateReply $rate_reply, $shop_settings, $settings)
    {
        return new FedexSoapRateReplyInterpretation($rate_reply, $shop_settings->is_tax_enabled(), $settings->get_value(FedexSettingsDefinition::FIELD_REQUEST_TYPE, FedexSettingsDefinition::FIELD_REQUEST_TYPE_VALUE_ALL));
    }
    /**
     * Create reply interpretation.
     *
     * @param RatesResponse $rates_response .
     * @param ShopSettings $shop_settings .
     * @param SettingsValues $settings .
     *
     * @return FedexRestApiRateReplyInterpretation
     */
    protected function create_rest_api_reply_interpretation(RatesResponse $rates_response, $shop_settings, $settings)
    {
        return new FedexRestApiRateReplyInterpretation($rates_response, $shop_settings->is_tax_enabled(), $settings->get_value(FedexSettingsDefinition::FIELD_REQUEST_TYPE, FedexSettingsDefinition::FIELD_REQUEST_TYPE_VALUE_ALL));
    }
    /**
     * Rate shipment.
     *
     * @param SettingsValues $settings Settings Values.
     * @param Shipment $shipment Shipment.
     *
     * @return ShipmentRating
     * @throws InvalidSettingsException InvalidSettingsException.
     * @throws RateException RateException.
     * @throws UnitConversionException Weight exception.
     */
    public function rate_shipment(SettingsValues $settings, Shipment $shipment)
    {
        if (!$this->get_settings_definition()->validate_settings($settings)) {
            throw new InvalidSettingsException();
        }
        $validate_shipment = new FedexValidateShipment($shipment, $this->logger);
        $this->verify_currency($this->shop_settings->get_default_currency(), $this->shop_settings->get_currency());
        if ($validate_shipment->is_weight_exceeded()) {
            return new ShipmentRatingImplementation([]);
        }
        if ($settings->get_value(FedexSettingsDefinition::API_TYPE, FedexSettingsDefinition::API_TYPE_SOAP) === FedexSettingsDefinition::API_TYPE_REST) {
            $request_builder = $this->create_rest_api_rate_request_builder($settings, $shipment, $this->shop_settings);
            $api_shipment = $request_builder->build_api_shipment();
            $rates = $api_shipment->getRates($this->rate_request_control_parameters);
            $reply = $this->create_rest_api_reply_interpretation($rates, $this->shop_settings, $settings);
            if ($reply::has_reply_warning($rates)) {
                foreach ($reply::get_reply_messages($rates) as $message) {
                    $this->logger->info($message['message']);
                }
            }
        } else {
            $request_builder = $this->create_soap_rate_request_builder($settings, $shipment, $this->shop_settings);
            $request = $request_builder->build_request();
            $this->set_sender(new FedexSender($this->logger, $this->is_testing($settings)));
            $response = $this->get_sender()->send($request);
            $reply = $this->create_soap_reply_interpretation($response, $this->shop_settings, $settings);
            if ($reply::has_reply_warning($response)) {
                $this->logger->info($reply::get_reply_message($response));
            }
        }
        return new FedexRateCustomServicesFilter($this->create_filter_rates_by_currency($reply), $settings);
    }
    /**
     * Create rest api rate request builder.
     *
     * @param SettingsValues $settings .
     * @param Shipment       $shipment .
     * @param ShopSettings   $shop_settings .
     *
     * @return FedexRestApiRateRequestBuilder
     */
    protected function create_rest_api_rate_request_builder(SettingsValues $settings, Shipment $shipment, ShopSettings $shop_settings)
    {
        return new FedexRestApiRateRequestBuilder($settings, $shipment, $shop_settings, $this->logger, $this->auth_provider_class);
    }
    /**
     * Create soap rate request builder.
     *
     * @param SettingsValues $settings .
     * @param Shipment       $shipment .
     * @param ShopSettings   $shop_settings .
     *
     * @return FedexSoapRateRequestBuilder
     */
    protected function create_soap_rate_request_builder(SettingsValues $settings, Shipment $shipment, ShopSettings $shop_settings)
    {
        return new FedexSoapRateRequestBuilder($settings, $shipment, $shop_settings);
    }
    /**
     * Creates rate filter by currency.
     *
     * @param ShipmentRating $rating .
     *
     * @return FedexRateCurrencyFilter .
     */
    protected function create_filter_rates_by_currency(ShipmentRating $rating)
    {
        return new FedexRateCurrencyFilter($rating, $this->shop_settings);
    }
    /**
     * Verify currency.
     *
     * @param string $default_shop_currency Shop currency.
     * @param string $checkout_currency Checkout currency.
     *
     * @return void
     * @throws CurrencySwitcherException .
     */
    protected function verify_currency($default_shop_currency, $checkout_currency)
    {
        if ($default_shop_currency !== $checkout_currency) {
            throw new CurrencySwitcherException($this->shop_settings);
        }
    }
    /**
     * Should I use a test API?
     *
     * @param \WPDesk\AbstractShipping\Settings\SettingsValues $settings Settings.
     *
     * @return bool
     */
    public function is_testing(SettingsValues $settings)
    {
        $testing = \false;
        if ($settings->has_value('testing') && $this->shop_settings->is_testing()) {
            $testing = 'yes' === $settings->get_value('testing') ? \true : \false;
        }
        return $testing;
    }
    /**
     * Get settings
     *
     * @return FedexSettingsDefinition
     */
    public function get_settings_definition()
    {
        return new FedexSettingsDefinition($this->shop_settings);
    }
    /**
     * Get unique ID.
     *
     * @return string
     */
    public function get_unique_id()
    {
        return self::UNIQUE_ID;
    }
    /**
     * Get name.
     *
     * @return string
     */
    public function get_name()
    {
        return __('FedEx Live Rates', 'flexible-shipping-fedex');
    }
    /**
     * Get description.
     *
     * @return string
     */
    public function get_description()
    {
        $link = $this->shop_settings->get_locale() === 'pl_PL' ? 'https://octol.io/fedex-settings-docs-pl' : 'https://octol.io/fedex-setting-docs';
        return sprintf(__('Dynamically calculated FedEx live rates based on the established FedEx API connection. %1$sLearn more →%2$s', 'flexible-shipping-fedex'), '<a href="' . $link . '" target="_blank">', '</a>');
    }
    /**
     * Pings API.
     * Returns empty string on success or error message on failure.
     *
     * @param SettingsValues  $settings .
     * @param LoggerInterface $logger .
     * @return string
     */
    public function check_connection(SettingsValues $settings, LoggerInterface $logger)
    {
        try {
            $connection_checker = new ConnectionChecker($settings, $logger, $this->is_testing($settings), $this->auth_provider_class);
            $connection_checker->check_connection();
            return '';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    /**
     * Returns field ID after which API Status field should be added.
     *
     * @return string
     */
    public function get_field_before_api_status_field()
    {
        return FedexSettingsDefinition::FIELD_API_PASSWORD;
    }
}
