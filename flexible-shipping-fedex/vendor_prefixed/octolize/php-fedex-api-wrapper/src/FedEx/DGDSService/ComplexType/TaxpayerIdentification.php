<?php

namespace FedExVendor\FedEx\DGDSService\ComplexType;

use FedExVendor\FedEx\AbstractComplexType;
/**
 * TaxpayerIdentification
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Dangerous Goods Data Service
 *
 * @property \FedEx\DGDSService\SimpleType\TinType|string $TinType
 * @property string $Number
 * @property string $Usage
 * @property string $EffectiveDate
 * @property string $ExpirationDate
 */
class TaxpayerIdentification extends AbstractComplexType
{
    /**
     * Name of this complex type
     *
     * @var string
     */
    protected $name = 'TaxpayerIdentification';
    /**
     * Set TinType
     *
     * @param \FedEx\DGDSService\SimpleType\TinType|string $tinType
     * @return $this
     */
    public function setTinType($tinType)
    {
        $this->values['TinType'] = $tinType;
        return $this;
    }
    /**
     * Set Number
     *
     * @param string $number
     * @return $this
     */
    public function setNumber($number)
    {
        $this->values['Number'] = $number;
        return $this;
    }
    /**
     * Identifies the usage of Tax Identification Number in Shipment processing
     *
     * @param string $usage
     * @return $this
     */
    public function setUsage($usage)
    {
        $this->values['Usage'] = $usage;
        return $this;
    }
    /**
     * Set EffectiveDate
     *
     * @param string $effectiveDate
     * @return $this
     */
    public function setEffectiveDate($effectiveDate)
    {
        $this->values['EffectiveDate'] = $effectiveDate;
        return $this;
    }
    /**
     * Set ExpirationDate
     *
     * @param string $expirationDate
     * @return $this
     */
    public function setExpirationDate($expirationDate)
    {
        $this->values['ExpirationDate'] = $expirationDate;
        return $this;
    }
}
