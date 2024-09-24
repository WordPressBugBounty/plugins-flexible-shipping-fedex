<?php

namespace FedExVendor\CageA80\FedEx;

class FedEx
{
    protected array $config = [];
    public function __construct(array $config = [])
    {
        $this->config = $config;
    }
    public function shipment() : \FedExVendor\CageA80\FedEx\Shipment
    {
        return new \FedExVendor\CageA80\FedEx\Shipment($this->config);
    }
}
