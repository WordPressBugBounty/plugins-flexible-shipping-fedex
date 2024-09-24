<?php

namespace FedExVendor\CageA80\FedEx;

class RateRequestControlParameters
{
    const RETURN_TRANSIT_TIMES = 'returnTransitTimes';
    private array $data = [];
    public function __construct()
    {
        $this->data = [self::RETURN_TRANSIT_TIMES => \false];
    }
    public function setReturnTransitAndCommit(bool $value) : void
    {
        $this->data[self::RETURN_TRANSIT_TIMES] = $value;
    }
    public function getData() : array
    {
        return $this->data;
    }
}
