<?php

namespace FedExVendor\CageA80\FedEx;

use FedExVendor\CageA80\FedEx\Exceptions\ValidationException;
use FedExVendor\CageA80\FedEx\Services\Rates\RatesRequest;
use FedExVendor\CageA80\FedEx\Services\Rates\RatesResponse;
use FedExVendor\CageA80\FedEx\Support\DimensionUnit;
use FedExVendor\CageA80\FedEx\Support\EdtRequestType;
use FedExVendor\CageA80\FedEx\Support\PaymentMethod;
use FedExVendor\CageA80\FedEx\Support\PickupType;
use FedExVendor\CageA80\FedEx\Support\RateRequestType;
use FedExVendor\CageA80\FedEx\Support\ShipmentPurpose;
use FedExVendor\CageA80\FedEx\Support\WeightUnit;
use FedExVendor\Psr\Log\NullLogger;
/**
 * Class Shipment
 *
 * $config = [
 *  'preferredCurrency' => string,
 *  'rateRequestType' => array<RateRequestType>,
 *  'pickupType' => PickupType,
 *  'packagingType' => PackagingType,
 *  'edtRequestType' => EdtRequestType,
 * ]
 *
 * @package FedEx
 */
class Shipment
{
    protected array $config;
    protected array $data;
    public function __construct(array $config = [])
    {
        $this->config = $config;
        // provide default values
        $this->data = ['rateRequestType' => $config['rateRequestType'] ?? [RateRequestType::LIST, RateRequestType::ACCOUNT], 'pickupType' => $config['pickupType'] ?? PickupType::DROPOFF_AT_FEDEX_LOCATION, 'requestedPackageLineItems' => [], 'customsClearanceDetail' => ['commercialInvoice' => ['shipmentPurpose' => ShipmentPurpose::SOLD], 'dutiesPayment' => ['paymentType' => $config['paymentType'] ?? PaymentMethod::SENDER], 'commodities' => []]];
        if (!empty($config['packagingType'])) {
            $this->data['packagingType'] = $config['packagingType'];
        }
        if (!empty($config['preferredCurrency'])) {
            $this->data['preferredCurrency'] = $config['preferredCurrency'];
        }
        if (!empty($config['customsClearanceDetail'])) {
            $this->data['customsClearanceDetail'] = $config['customsClearanceDetail'];
        }
    }
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }
    /**
     * @param $name
     * @return mixed|null
     */
    public function __get($name)
    {
        return $this->data[$name] ?? null;
    }
    public function setPackagingType(string $packagingType): void
    {
        $this->data['packagingType'] = $packagingType;
    }
    /**
     * @param string $name
     * @param array|string|bool $data
     *
     * @return bool
     */
    public function addShipmentSpecialService(string $name, $data): void
    {
        $this->data['shipmentSpecialServices'][$name] = $data;
    }
    public function setShipDateStamp(string $dateStamp): void
    {
        $this->data['shipDateStamp'] = $dateStamp;
    }
    public function setPreferredCurrency(string $currency): void
    {
        $this->data['preferredCurrency'] = $currency;
    }
    public function setServiceType(string $serviceType): void
    {
        $this->data['serviceType'] = $serviceType;
    }
    public function addRateRequestType(string $rateRequestType): void
    {
        $this->data['rateRequestType'][] = $rateRequestType;
    }
    public function setRateRequestType(array $rateRequestType): void
    {
        $this->data['rateRequestType'] = $rateRequestType;
    }
    /**
     * Specify sender address
     *
     * @param array $address
     * @return $this
     * @throws ValidationException
     */
    public function from(array $address): self
    {
        $this->validateAddress($address, 'shipper')->data['shipper'] = ['address' => $address];
        return $this;
    }
    /**
     * Specify receiver address
     *
     * @param array $address
     * @return $this
     * @throws ValidationException
     */
    public function to(array $address): self
    {
        $this->validateAddress($address, 'recipient')->data['recipient'] = ['address' => $address];
        return $this;
    }
    /**
     * Add a package to the shipment
     *
     * @param array $package
     * @return $this
     * @throws ValidationException
     */
    public function addPackage(array $package): self
    {
        if (isset($package['weight'])) {
            if (is_numeric($package['weight'])) {
                $package['weight'] = ['value' => $package['weight']];
            }
            if (is_array($package['weight']) && !isset($package['weight']['units'])) {
                $package['weight']['units'] = $this->config['weightUnits'] ?? WeightUnit::LB;
            }
        }
        $this->validatePackage($package)->data['requestedPackageLineItems'][] = $package;
        return $this;
    }
    /**
     * Add a collection of packages to the shipment
     *
     * @param array $packages
     * @return $this
     * @throws ValidationException
     */
    public function addPackages(array $packages): self
    {
        foreach ($packages as $package) {
            $this->addPackage($package);
        }
        return $this;
    }
    /**
     * Add a commodity to the shipment
     *
     * @param array $commodity
     * @return $this
     * @throws ValidationException
     */
    public function addCommodity(array $commodity): self
    {
        $commodity['name'] = html_entity_decode(isset($commodity['name']) ? $commodity['name'] : '');
        $commodity['name'] = str_replace(';', '', $commodity['name']);
        $this->validateCommodity($commodity)->data['customsClearanceDetail']['commodities'][] = $commodity;
        return $this;
    }
    /**
     * Add a collection of commodities to the shipment
     *
     * @param array $commodities
     * @return $this
     * @throws ValidationException
     */
    public function addCommodities(array $commodities): self
    {
        foreach ($commodities as $commodity) {
            $this->addCommodity($commodity);
        }
        return $this;
    }
    /**
     * Return shipment data body
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
    /**
     * Get shipping rates for the shipment
     *
     * @param RateRequestControlParameters|null $rateRequestControlParameters
     *
     * @return RatesResponse
     */
    public function getRates(RateRequestControlParameters $rateRequestControlParameters = null): RatesResponse
    {
        $ratesService = new RatesRequest($this->config);
        return $ratesService->getRates($this, $rateRequestControlParameters);
    }
    // region [VALIDATION]
    protected function validateAddress(array $address, string $type): self
    {
        if (empty($address['postalCode'])) {
            throw new ValidationException(ucfirst($type) . ' postal code is required');
        }
        if (empty($address['countryCode'])) {
            throw new ValidationException(ucfirst($type) . ' country code is required');
        }
        return $this;
    }
    protected function validatePackage(array $package): self
    {
        if (empty($package['weight']) || !is_array($package['weight'])) {
            throw new ValidationException('Package weight is required');
        }
        if (!in_array($package['weight']['units'], [WeightUnit::KG, WeightUnit::LB])) {
            throw new ValidationException('Invalid package weight units: ' . $package['weight']['units']);
        }
        if (!is_numeric(@$package['weight']['value']) || $package['weight']['value'] < 0) {
            throw new ValidationException('Invalid package weight: ' . $package['weight']['value']);
        }
        if (($this->config['maxPackageWeight'] ?? 0) && round($package['weight']['value'], 8) > round($this->config['maxPackageWeight'], 8)) {
            throw new ValidationException('Package weight should be less or equal than ' . $this->config['maxPackageWeight']);
        }
        if (isset($package['dimensions'])) {
            if (empty($package['dimensions']['length'])) {
                throw new ValidationException('Package dimension length is required');
            }
            if (empty($package['dimensions']['width'])) {
                throw new ValidationException('Package dimension width is required');
            }
            if (empty($package['dimensions']['height'])) {
                throw new ValidationException('Package dimension height is required');
            }
            if (!in_array($package['dimensions']['units'], [DimensionUnit::CENTIMETERS, DimensionUnit::INCHES])) {
                throw new ValidationException('Invalid package dimension units: ' . $package['dimensions']['units']);
            }
        }
        return $this;
    }
    protected function validateCommodity(array $commodity): self
    {
        if (!count($commodity)) {
            throw new ValidationException('Commodity could not be empty');
        }
        if (!isset($commodity['name']) || !$commodity['name']) {
            throw new ValidationException('Commodity name is required');
        }
        if (isset($commodity['customsValue'])) {
            if (empty($commodity['customsValue']['amount'])) {
                throw new ValidationException('Commodity customsValue.amount is required');
            }
            if (empty($commodity['customsValue']['currency'])) {
                throw new ValidationException('Commodity customsValue.currency is required');
            }
        }
        return $this;
    }
    // endregion
}
