<?php

namespace FedExVendor\WPDesk\FedexShippingService\FedexApi\RestApi;

use FedExVendor\CageA80\FedEx\Services\Rates\RatesResponse;
use FedExVendor\WPDesk\AbstractShipping\Rate\Money;
use FedExVendor\WPDesk\AbstractShipping\Rate\ShipmentRating;
use FedExVendor\WPDesk\AbstractShipping\Rate\SingleRate;
use FedExVendor\WPDesk\FedexShippingService\FedexApi\FedexRequestManipulation;
/**
 * Get response from API
 *
 * @package WPDesk\FedexShippingService\FedexApi
 */
class FedexRestApiRateReplyInterpretation implements ShipmentRating
{
    private bool $is_tax_enabled;
    private RatesResponse $rates_response;
    private string $rate_type;
    /**
     * FedexResponse constructor.
     *
     * @param RatesResponse $rates_response Rate reply.
     * @param bool $is_tax_enabled Is tax enabled.
     * @param string $rate_type Setting value of FedexSettingsDefinition::FIELD_REQUEST_TYPE
     */
    public function __construct(RatesResponse $rates_response, bool $is_tax_enabled, string $rate_type)
    {
        $this->rates_response = $rates_response;
        $this->is_tax_enabled = $is_tax_enabled;
        $this->rate_type = $rate_type;
    }
    /**
     * Get reply error message.
     *
     * @param RatesResponse $rates_response Rate reply.
     *
     * @return array
     */
    public static function get_reply_messages(RatesResponse $rates_response): array
    {
        return $rates_response->alerts();
    }
    /**
     * Has reply warning.
     *
     * @param RatesResponse $rates_response Rate reply.
     *
     * @return bool
     */
    public static function has_reply_warning(RatesResponse $rates_response): bool
    {
        return count($rates_response->alerts()) > 0;
    }
    /**
     * Get single rate.
     *
     * @param array $rate_detail .
     * @param array $rated_shipment_detail .
     *
     * @return SingleRate
     */
    protected function get_single_rate(array $rate_detail, array $rated_shipment_detail): SingleRate
    {
        $rate = new SingleRate();
        $money = new Money();
        $money->currency = FedexRequestManipulation::convert_currency_from_fedex($rated_shipment_detail['currency']);
        if ($this->is_tax_enabled) {
            $money->amount = $rated_shipment_detail['totalNetFedExCharge'];
        } else {
            $money->amount = $rated_shipment_detail['totalNetCharge'];
        }
        $rate->total_charge = $money;
        $rate->service_type = $rate_detail['serviceType'];
        $rate->service_name = $rate_detail['serviceName'];
        return $rate;
    }
    /**
     * @return RatesResponse
     */
    public function get_rates_response(): RatesResponse
    {
        return $this->rates_response;
    }
    /**
     * Get response from FedEx.
     *
     * @return SingleRate[]
     */
    public function get_ratings(): array
    {
        $rate_response = $this->get_rates_response();
        if (empty($rate_response->details())) {
            return [];
        }
        $rates = [];
        foreach ($rate_response->getRateReplyDetails() as $rate_detail) {
            foreach ($rate_detail['ratedShipmentDetails'] as $rated_shipment_detail) {
                if ($this->rate_type !== 'all' && $this->rate_type !== $rated_shipment_detail['rateType'] && 'PREFERRED_CURRENCY' !== $rated_shipment_detail['rateType']) {
                    continue;
                }
                if (isset($rate_detail['serviceType'])) {
                    $rates[] = $this->get_single_rate($rate_detail, $rated_shipment_detail);
                }
            }
        }
        return $rates;
    }
}
