<?php

namespace FedExVendor\WPDesk\FedexShippingService\FedexApi\Soap;

use DateTime;
use FedExVendor\FedEx\RateService\ComplexType;
use FedExVendor\FedEx\RateService\ComplexType\RateRequest;
use FedExVendor\FedEx\RateService\ComplexType\RequestedPackageLineItem;
use FedExVendor\FedEx\RateService\ComplexType\RequestedShipment;
use FedExVendor\FedEx\RateService\SimpleType;
use FedExVendor\FedEx\ShipService\SimpleType\PackagingType;
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
 *
 * @package WPDesk\FedexShippingService\FedexApi
 */
class FedexSoapRateRequestBuilder
{
    /**
     * API Version
     */
    const API_VERSION = 31;
    /**
     * Service ID.
     */
    const SERVICE_ID = 'crs';
    /**
     * Customer transaction ID.
     */
    const CUSTOMER_TRANSACTION_ID = 'Flexible Shipping FedEx';
    /**
     * WooCommerce shipment.
     *
     * @var Shipment
     */
    private $shipment;
    /**
     * Settings values.
     *
     * @var SettingsValues
     */
    private $settings;
    /**
     * Request
     *
     * @var RateRequest
     */
    private $request;
    /**
     * Shop settings.
     *
     * @var ShopSettings
     */
    private $shop_settings;
    /**
     * FedexRequest constructor.
     *
     * @param SettingsValues $settings Settings.
     * @param Shipment $shipment Shipment.
     * @param ShopSettings $helper Helper.
     */
    public function __construct(SettingsValues $settings, Shipment $shipment, ShopSettings $helper)
    {
        $this->settings = $settings;
        $this->shipment = $shipment;
        $this->shop_settings = $helper;
        $this->request = new ComplexType\RateRequest();
    }
    /**
     * Set authentication FedEx credentials
     */
    private function set_credentials()
    {
        $this->request->WebAuthenticationDetail->UserCredential->Key = $this->settings->get_value('api_key');
        $this->request->WebAuthenticationDetail->UserCredential->Password = $this->settings->get_value('api_password');
        $this->request->ClientDetail->AccountNumber = $this->settings->get_value('account_number');
        $this->request->ClientDetail->MeterNumber = $this->settings->get_value('meter_number');
        $this->request->TransactionDetail->CustomerTransactionId = self::CUSTOMER_TRANSACTION_ID;
    }
    /**
     * Set api version
     */
    private function set_api_version()
    {
        $this->request->Version->ServiceId = self::SERVICE_ID;
        $this->request->Version->Major = self::API_VERSION;
        $this->request->Version->Minor = 0;
        $this->request->Version->Intermediate = 0;
        $this->request->ReturnTransitAndCommit = \true;
    }
    /**
     * Set shipper address
     */
    private function set_shipper_address()
    {
        if ($this->shipment->ship_from->address instanceof Address) {
            $ship_from = $this->shipment->ship_from->address;
            $this->request->RequestedShipment->Shipper->Address->StreetLines = [FedexRequestManipulation::convert_to_utf7($ship_from->address_line1), FedexRequestManipulation::convert_to_utf7($ship_from->address_line2)];
            $this->request->RequestedShipment->Shipper->Address->City = FedexRequestManipulation::convert_to_utf7($ship_from->city);
            $this->request->RequestedShipment->Shipper->Address->StateOrProvinceCode = FedexRequestManipulation::filter_province_for_fedex($ship_from->state_code);
            $this->request->RequestedShipment->Shipper->Address->PostalCode = $ship_from->postal_code;
            $this->request->RequestedShipment->Shipper->Address->CountryCode = $ship_from->country_code;
        }
    }
    /**
     * Is residential address.
     *
     * @return bool
     */
    private function is_residential()
    {
        return $this->settings->has_value('destination_address_type') && '1' === $this->settings->get_value('destination_address_type');
    }
    /**
     * Set recipient address
     */
    private function set_recipient_address()
    {
        if ($this->shipment->ship_to->address instanceof Address) {
            $ship_to = $this->shipment->ship_to->address;
            $this->request->RequestedShipment->Recipient->Address->StreetLines = [FedexRequestManipulation::convert_to_utf7($ship_to->address_line1), FedexRequestManipulation::convert_to_utf7($ship_to->address_line2)];
            $this->request->RequestedShipment->Recipient->Address->City = FedexRequestManipulation::convert_to_utf7($ship_to->city);
            $this->request->RequestedShipment->Recipient->Address->StateOrProvinceCode = FedexRequestManipulation::filter_province_for_fedex($ship_to->state_code);
            $this->request->RequestedShipment->Recipient->Address->PostalCode = $ship_to->postal_code;
            $this->request->RequestedShipment->Recipient->Address->CountryCode = $ship_to->country_code;
            $this->request->RequestedShipment->Recipient->Address->Residential = $this->is_residential();
        }
    }
    /**
     * Set insurance data in RequestedPackageLineItem when needed
     *
     * @param RequestedPackageLineItem $requested_package Packed shipment item.
     * @param Money $money Declared item/package value.
     *
     * @return RequestedPackageLineItem
     */
    private function handle_insurance(RequestedPackageLineItem $requested_package, Money $money)
    {
        if ('yes' === $this->settings->get_value(FedexSettingsDefinition::FIELD_INSURANCE)) {
            $requested_package->InsuredValue->Amount = $money->amount;
            $requested_package->InsuredValue->Currency = FedexRequestManipulation::convert_currency_to_fedex($money->currency);
        }
        return $requested_package;
    }
    /**
     * Sum all items declared value if can.
     * Warning: we assume the same currency in all items.
     *
     * @param Item[] $items
     *
     * @return Money Id currency is null then it's probably have no sense
     */
    private function sum_items_value(array $items)
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
     * @param int $number
     *
     * @return RequestedPackageLineItem
     * @throws UnitConversionException
     */
    private function create_package_from_package(Package $package, $number)
    {
        $requested_package = new RequestedPackageLineItem();
        $requested_package->SequenceNumber = $number;
        if ($package->weight instanceof Weight) {
            $this->set_weight($requested_package, $package->weight);
        }
        if ($package->dimensions instanceof Dimensions) {
            $dimension = new \FedExVendor\FedEx\RateService\ComplexType\Dimensions();
            $dimension->Height = ceil($package->dimensions->height);
            $dimension->Length = ceil($package->dimensions->length);
            $dimension->Width = ceil($package->dimensions->width);
            $dimension->Units = FedexRequestManipulation::convert_dimension_unit($package->dimensions->dimensions_unit);
            $requested_package->setDimensions($dimension);
        }
        $value = $this->sum_items_value($package->items);
        if ($value->currency !== null) {
            $this->handle_insurance($requested_package, $value);
        }
        $requested_package->setGroupPackageCount(1);
        return $requested_package;
    }
    /**
     * Set package item.
     *
     * @throws \Exception Measure converter exception.
     */
    private function set_items()
    {
        $line_items = [];
        $counter = 1;
        foreach ($this->shipment->packages as $package) {
            $line_items[] = $this->create_package_from_package($package, $counter++);
        }
        $this->request->RequestedShipment->RequestedPackageLineItems = $line_items;
        $this->request->RequestedShipment->PackageCount = count($line_items);
    }
    /**
     * Returns weight unit in which FedEx request would be sent.
     *
     * @return string
     */
    private function get_target_weight_unit()
    {
        $unit = $this->settings->get_value(FedexSettingsDefinition::FIELD_UNITS, FedexSettingsDefinition::UNITS_METRIC);
        return $unit === FedexSettingsDefinition::UNITS_METRIC ? Weight::WEIGHT_UNIT_KG : Weight::WEIGHT_UNIT_LB;
    }
    /**
     * Returns dimension unit in which FedEx request would be sent.
     *
     * @return string
     */
    private function get_target_dimension_unit()
    {
        $unit = $this->settings->get_value(FedexSettingsDefinition::FIELD_UNITS, FedexSettingsDefinition::UNITS_METRIC);
        return $unit === FedexSettingsDefinition::UNITS_METRIC ? Dimensions::DIMENSION_UNIT_CM : Dimensions::DIMENSION_UNIT_IN;
    }
    /**
     * Set weight.
     *
     * @param RequestedPackageLineItem $requested_package Requested package.
     * @param Weight $itemWeight Weight.
     *
     * @return RequestedPackageLineItem
     * @throws UnitConversionException Unit conversion exception.
     */
    private function set_weight(RequestedPackageLineItem $requested_package, Weight $itemWeight)
    {
        $target_weight_unit = $this->get_target_weight_unit();
        try {
            $weight = (new UniversalWeight($itemWeight->weight, $itemWeight->weight_unit))->as_unit_rounded($target_weight_unit, 3);
            $requested_package->Weight->Value = max($weight, 0.001);
            $requested_package->Weight->Units = FedexRequestManipulation::convert_weight_unit($target_weight_unit);
        } catch (\Throwable $e) {
            throw new UnitConversionException($e->getMessage());
        } catch (\Exception $e) {
            // required fallback from Throwable in PHP 5.6
            throw new UnitConversionException($e->getMessage());
        }
        return $requested_package;
    }
    /**
     * Sets rate type in given shipment.
     * Check for additional work in FedexRateReplyInterpretation.php as rate response is probably filtered according to these data.
     *
     * @param RequestedShipment $shipment
     */
    private function set_rate_type(RequestedShipment $shipment)
    {
        $rate_type = $this->settings->get_value(FedexSettingsDefinition::FIELD_REQUEST_TYPE, FedexSettingsDefinition::FIELD_REQUEST_TYPE_VALUE_ALL);
        switch ($rate_type) {
            case SimpleType\RateRequestType::_LIST:
                $shipment->RateRequestTypes = [SimpleType\RateRequestType::_LIST];
                break;
            case FedexSettingsDefinition::FIELD_REQUEST_TYPE_VALUE_ALL:
            default:
                $shipment->RateRequestTypes = [SimpleType\RateRequestType::_NONE];
                break;
        }
    }
    /**
     * Set purpose of shipment.
     */
    private function set_purpose_of_shipment()
    {
        $this->request->RequestedShipment->CustomsClearanceDetail->CommercialInvoice->Purpose = SimpleType\PurposeOfShipmentType::_SOLD;
    }
    /**
     * Set additional request data.
     */
    private function set_additional_data()
    {
        $this->request->RequestedShipment->PackagingType = $this->prepare_packaging_type();
        $this->request->RequestedShipment->ShippingChargesPayment->PaymentType = SimpleType\PaymentType::_SENDER;
        $this->request->RequestedShipment->DropoffType = SimpleType\DropoffType::_REGULAR_PICKUP;
        $this->request->RequestedShipment->ShipTimestamp = (new DateTime())->format('c');
        $this->set_rate_type($this->request->RequestedShipment);
    }
    /**
     * @return string
     */
    private function prepare_packaging_type()
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
            $package_type = PackagingType::_YOUR_PACKAGING;
        }
        return $package_type;
    }
    /**
     * @return array
     */
    private function get_built_in_packaging_types()
    {
        return array(PackagingType::_FEDEX_TUBE, PackagingType::_FEDEX_PAK, PackagingType::_FEDEX_LARGE_BOX, PackagingType::_FEDEX_SMALL_BOX, PackagingType::_FEDEX_10KG_BOX, PackagingType::_FEDEX_BOX, PackagingType::_FEDEX_25KG_BOX, PackagingType::_FEDEX_ENVELOPE, PackagingType::_FEDEX_EXTRA_LARGE_BOX, PackagingType::_FEDEX_MEDIUM_BOX);
    }
    /**
     * Build request.
     */
    public function build_request()
    {
        $this->set_credentials();
        $this->set_api_version();
        $this->set_shipper_address();
        $this->set_recipient_address();
        $this->set_items();
        $this->set_purpose_of_shipment();
        $this->set_additional_data();
        return $this->request;
    }
}
