<?php

namespace FedExVendor\FedEx\InFlightShipmentService\ComplexType;

use FedExVendor\FedEx\AbstractComplexType;
/**
 * Money
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  In Flight Shipment Service
 *
 * @property string $Currency
 * @property float $Amount
 */
class Money extends AbstractComplexType
{
    /**
     * Name of this complex type
     *
     * @var string
     */
    protected $name = 'Money';
    /**
     * Set Currency
     *
     * @param string $currency
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->values['Currency'] = $currency;
        return $this;
    }
    /**
     * Set Amount
     *
     * @param float $amount
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->values['Amount'] = $amount;
        return $this;
    }
}
