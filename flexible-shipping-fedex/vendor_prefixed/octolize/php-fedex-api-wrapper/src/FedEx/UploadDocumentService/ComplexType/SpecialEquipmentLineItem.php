<?php

namespace FedExVendor\FedEx\UploadDocumentService\ComplexType;

use FedExVendor\FedEx\AbstractComplexType;
/**
 * Specifies the usage of a single type of special equipment while loading/unloading a shipment
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Upload Document Service
 *
 * @property \FedEx\UploadDocumentService\SimpleType\SpecialEquipmentType|string $Type
 * @property string $Duration
 */
class SpecialEquipmentLineItem extends AbstractComplexType
{
    /**
     * Name of this complex type
     *
     * @var string
     */
    protected $name = 'SpecialEquipmentLineItem';
    /**
     * Type of equipment used
     *
     * @param \FedEx\UploadDocumentService\SimpleType\SpecialEquipmentType|string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->values['Type'] = $type;
        return $this;
    }
    /**
     * Total amount of time the equipment was used
     *
     * @param string $duration
     * @return $this
     */
    public function setDuration($duration)
    {
        $this->values['Duration'] = $duration;
        return $this;
    }
}
