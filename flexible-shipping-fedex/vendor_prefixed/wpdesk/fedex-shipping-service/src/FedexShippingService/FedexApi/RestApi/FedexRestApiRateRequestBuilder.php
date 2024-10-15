<?php

namespace FedExVendor\WPDesk\FedexShippingService\FedexApi\RestApi;

use FedExVendor\CageA80\FedEx\FedEx;
use FedExVendor\CageA80\FedEx\Support\PackagingType;
use FedExVendor\CageA80\FedEx\Support\RateRequestType;
use FedExVendor\Psr\Log\LoggerInterface;
use FedExVendor\WPDesk\AbstractShipping\Exception\UnitConversionException;
use FedExVendor\WPDesk\AbstractShipping\Rate\Money;
use FedExVendor\WPDesk\AbstractShipping\Settings\SettingsValues;
use FedExVendor\WPDesk\AbstractShipping\Shipment\Address;
use FedExVendor\WPDesk\AbstractShipping\Shipment\Dimensions;
use FedExVendor\WPDesk\AbstractShipping\Shipment\Item;
use FedExVendor\WPDesk\AbstractShipping\Shipment\Package;
use FedExVendor\WPDesk\AbstractShipping\Shipment\Shipment;
use FedExVendor\WPDesk\AbstractShipping\Shipment\Weight;
use FedExVendor\WPDesk\AbstractShipping\Shop\ShopSettings;
use FedExVendor\WPDesk\AbstractShipping\UnitConversion\UniversalWeight;
use FedExVendor\WPDesk\FedexShippingService\FedexApi\FedexRequestManipulation;
use FedExVendor\WPDesk\FedexShippingService\FedexSettingsDefinition;
/**
 * Build request for FedEx rate
 */
class FedexRestApiRateRequestBuilder
{
    /**
     * WooCommerce shipment.
     */
    private Shipment $shipment;
    private SettingsValues $settings;
    private ShopSettings $shop_settings;
    private \FedExVendor\CageA80\FedEx\Shipment $api_shipment;
    private LoggerInterface $logger;
    /**
     * @var string|null
     */
    private string $auth_provider_class;
    /**
     * FedexRequest constructor.
     *
     * @param SettingsValues $settings Settings.
     * @param Shipment $shipment Shipment.
     * @param ShopSettings $helper Helper.
     * @param string|null $auth_provider_class .
     */
    public function __construct(SettingsValues $settings, Shipment $shipment, ShopSettings $helper, LoggerInterface $logger, string $auth_provider_class = null)
    {
        $this->settings = $settings;
        $this->shipment = $shipment;
        $this->shop_settings = $helper;
        $this->logger = $logger;
        $this->auth_provider_class = $auth_provider_class;
    }
    /**
     * Set shipper address
     */
    private function set_shipper_address(): void
    {
        if ($this->shipment->ship_from->address instanceof Address) {
            $streetLines = [$this->shipment->ship_from->address->address_line1];
            if ($this->shipment->ship_from->address->address_line2) {
                $streetLines[] = $this->shipment->ship_from->address->address_line2;
            }
            $this->api_shipment->from(['streetLines' => $streetLines, 'city' => $this->shipment->ship_from->address->city, 'stateOrProvinceCode' => FedexRequestManipulation::filter_province_for_fedex($this->shipment->ship_from->address->state_code), 'postalCode' => $this->shipment->ship_from->address->postal_code, 'countryCode' => $this->shipment->ship_from->address->country_code]);
        }
    }
    /**
     * Is residential address.
     *
     * @return bool
     */
    private function is_residential(): bool
    {
        return $this->settings->has_value('destination_address_type') && '1' === $this->settings->get_value('destination_address_type');
    }
    /**
     * Set recipient address
     */
    private function set_recipient_address(): void
    {
        if ($this->shipment->ship_to->address instanceof Address) {
            $streetLines = [$this->shipment->ship_to->address->address_line1];
            if ($this->shipment->ship_to->address->address_line2) {
                $streetLines[] = $this->shipment->ship_to->address->address_line2;
            }
            $this->api_shipment->to(['streetLines' => $streetLines, 'city' => $this->shipment->ship_to->address->city, 'stateOrProvinceCode' => FedexRequestManipulation::filter_province_for_fedex($this->shipment->ship_to->address->state_code), 'postalCode' => $this->shipment->ship_to->address->postal_code, 'countryCode' => $this->shipment->ship_to->address->country_code, 'residential' => $this->is_residential()]);
        }
    }
    /**
     * Set insurance data in RequestedPackageLineItem when needed
     *
     * @param array $aoi_package Packed shipment item.
     * @param Money $money Declared item/package value.
     *
     * @return array
     */
    private function handle_insurance(array $api_package, Money $money): array
    {
        if ('yes' === $this->settings->get_value(FedexSettingsDefinition::FIELD_INSURANCE)) {
            $api_package['declaredValue'] = ['amount' => $money->amount, 'currency' => FedexRequestManipulation::convert_currency_to_fedex($money->currency)];
        }
        return $api_package;
    }
    /**
     * Sum all items declared value if can.
     * Warning: we assume the same currency in all items.
     *
     * @param Item[] $items
     *
     * @return Money Id currency is null then it's probably have no sense
     */
    private function sum_items_value(array $items): Money
    {
        $value = new Money();
        $value->amount = 0;
        foreach ($items as $item) {
            if ($item->declared_value instanceof Money) {
                $value->amount += round($item->declared_value->amount, $this->shop_settings->get_price_rounding_precision());
                $value->currency = $item->declared_value->currency;
            }
        }
        return $value;
    }
    /**
     * Create FedEx package RequestedPackageLineItem from shipment package.
     *
     * @param Package $package
     *
     * @return array
     * @throws UnitConversionException
     */
    private function create_api_package_from_package(Package $package): array
    {
        $api_package = ['groupPackageCount' => 1];
        if ($package->weight instanceof Weight) {
            $api_package = $this->set_weight($api_package, $package->weight);
        }
        if ($package->dimensions instanceof Dimensions) {
            $api_package['dimensions'] = ['height' => ceil($package->dimensions->height), 'length' => ceil($package->dimensions->length), 'width' => ceil($package->dimensions->width), 'units' => FedexRequestManipulation::convert_dimension_unit($package->dimensions->dimensions_unit)];
        }
        $value = $this->sum_items_value($package->items);
        if ($value->currency !== null) {
            $api_package = $this->handle_insurance($api_package, $value);
        }
        return $api_package;
    }
    /**
     * Set package item.
     *
     * @throws \Exception Measure converter exception.
     */
    private function set_items(): void
    {
        foreach ($this->shipment->packages as $package) {
            $this->api_shipment->addPackage($this->create_api_package_from_package($package));
        }
    }
    /**
     * Returns weight unit in which FedEx request would be sent.
     *
     * @return string
     */
    private function get_target_weight_unit(): string
    {
        $unit = $this->settings->get_value(FedexSettingsDefinition::FIELD_UNITS, FedexSettingsDefinition::UNITS_METRIC);
        return $unit === FedexSettingsDefinition::UNITS_METRIC ? Weight::WEIGHT_UNIT_KG : Weight::WEIGHT_UNIT_LB;
    }
    /**
     * Returns dimension unit in which FedEx request would be sent.
     *
     * @return string
     */
    private function get_target_dimension_unit(): string
    {
        $unit = $this->settings->get_value(FedexSettingsDefinition::FIELD_UNITS, FedexSettingsDefinition::UNITS_METRIC);
        return $unit === FedexSettingsDefinition::UNITS_METRIC ? Dimensions::DIMENSION_UNIT_CM : Dimensions::DIMENSION_UNIT_IN;
    }
    /**
     * Set weight.
     *
     * @param array $api_package Requested package.
     * @param Weight $itemWeight Weight.
     *
     * @return array
     * @throws UnitConversionException Unit conversion exception.
     */
    private function set_weight(array $api_package, Weight $itemWeight): array
    {
        $target_weight_unit = $this->get_target_weight_unit();
        $api_package['weight'] = ['units' => FedexRequestManipulation::convert_weight_unit($target_weight_unit)];
        try {
            $weight = (new UniversalWeight($itemWeight->weight, $itemWeight->weight_unit))->as_unit_rounded($target_weight_unit, 3);
            $api_package['weight']['value'] = max($weight, 0.001);
        } catch (\Throwable $e) {
            throw new UnitConversionException($e->getMessage());
        }
        return $api_package;
    }
    private function get_rate_type(): array
    {
        $rate_type = $this->settings->get_value(FedexSettingsDefinition::FIELD_REQUEST_TYPE, FedexSettingsDefinition::FIELD_REQUEST_TYPE_VALUE_ALL);
        switch ($rate_type) {
            case RateRequestType::LIST:
                return [RateRequestType::LIST];
        }
        return [RateRequestType::ACCOUNT, RateRequestType::LIST];
    }
    /**
     * @return string
     */
    private function prepare_packaging_type(): string
    {
        $package_type = '';
        foreach ($this->shipment->packages as $package) {
            $package_pack_type = trim($package->package_type ?? '', '_');
            $package_type = '' === $package_type ? $package_pack_type : $package_type;
            if ($package_type !== $package_pack_type) {
                $package_type = 'custom';
            }
        }
        if (!in_array($package_type, $this->get_built_in_packaging_types(), \true)) {
            $package_type = PackagingType::YOUR_PACKAGING;
        }
        return $package_type;
    }
    /**
     * @return array
     */
    private function get_built_in_packaging_types(): array
    {
        return array(PackagingType::FEDEX_TUBE, PackagingType::FEDEX_PAK, PackagingType::FEDEX_LARGE_BOX, PackagingType::FEDEX_SMALL_BOX, PackagingType::FEDEX_10KG_BOX, PackagingType::FEDEX_BOX, PackagingType::FEDEX_25KG_BOX, PackagingType::FEDEX_ENVELOPE, PackagingType::FEDEX_EXTRA_LARGE_BOX, PackagingType::FEDEX_MEDIUM_BOX);
    }
    private function create_shipment(): void
    {
        $config = (new RestApiConfig($this->settings, $this->auth_provider_class))->prepare_config();
        $config['packagingType'] = $this->prepare_packaging_type();
        $config['rateRequestType'] = $this->get_rate_type();
        $config['logger'] = $this->logger;
        $fedex = new FedEx($config);
        $this->api_shipment = $fedex->shipment();
    }
    /**
     * Build request.
     */
    public function build_api_shipment(): \FedExVendor\CageA80\FedEx\Shipment
    {
        $this->create_shipment();
        $this->set_shipper_address();
        $this->set_recipient_address();
        $this->set_items();
        return $this->api_shipment;
    }
}
