<?php

namespace FedExVendor\FedEx\UploadDocumentService\ComplexType;

use FedExVendor\FedEx\AbstractComplexType;
/**
 * FreightGuaranteeDetail
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Upload Document Service
 *
 * @property \FedEx\UploadDocumentService\SimpleType\FreightGuaranteeType|string $Type
 * @property string $Date
 * @property string $Time
 */
class FreightGuaranteeDetail extends AbstractComplexType
{
    /**
     * Name of this complex type
     *
     * @var string
     */
    protected $name = 'FreightGuaranteeDetail';
    /**
     * Set Type
     *
     * @param \FedEx\UploadDocumentService\SimpleType\FreightGuaranteeType|string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->values['Type'] = $type;
        return $this;
    }
    /**
     * Date for all Freight guarantee types.
     *
     * @param string $date
     * @return $this
     */
    public function setDate($date)
    {
        $this->values['Date'] = $date;
        return $this;
    }
    /**
     * Time for GUARANTEED_TIME only.
     *
     * @param string $time
     * @return $this
     */
    public function setTime($time)
    {
        $this->values['Time'] = $time;
        return $this;
    }
}
