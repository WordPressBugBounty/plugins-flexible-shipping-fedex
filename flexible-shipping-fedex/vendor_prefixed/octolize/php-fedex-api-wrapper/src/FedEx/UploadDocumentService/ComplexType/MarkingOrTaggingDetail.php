<?php

namespace FedExVendor\FedEx\UploadDocumentService\ComplexType;

use FedExVendor\FedEx\AbstractComplexType;
/**
 * Specification for marking or tagging of pieces in shipment.
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Upload Document Service
 *
 * @property int $Count
 */
class MarkingOrTaggingDetail extends AbstractComplexType
{
    /**
     * Name of this complex type
     *
     * @var string
     */
    protected $name = 'MarkingOrTaggingDetail';
    /**
     * Number of pieces to be marked or tagged by FedEx.
     *
     * @param int $count
     * @return $this
     */
    public function setCount($count)
    {
        $this->values['Count'] = $count;
        return $this;
    }
}
