<?php

namespace FedExVendor\FedEx\UploadDocumentService\ComplexType;

use FedExVendor\FedEx\AbstractComplexType;
/**
 * Specifies additional labels to be produced. All required labels for shipments will be produced without the need to request additional labels. These are only available as thermal labels.
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Upload Document Service
 *
 * @property \FedEx\UploadDocumentService\SimpleType\AdditionalLabelsType|string $Type
 * @property int $Count
 */
class AdditionalLabelsDetail extends AbstractComplexType
{
    /**
     * Name of this complex type
     *
     * @var string
     */
    protected $name = 'AdditionalLabelsDetail';
    /**
     * The type of additional labels to return.
     *
     * @param \FedEx\UploadDocumentService\SimpleType\AdditionalLabelsType|string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->values['Type'] = $type;
        return $this;
    }
    /**
     * The number of this type label to return
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
