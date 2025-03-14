<?php

namespace FedExVendor\FedEx\UploadDocumentService\ComplexType;

use FedExVendor\FedEx\AbstractComplexType;
/**
 * Specifies the results of processing for the COD special service.
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Upload Document Service
 *
 * @property Money $CollectionAmount
 * @property \FedEx\UploadDocumentService\SimpleType\CodAdjustmentType|string $AdjustmentType
 */
class CompletedCodDetail extends AbstractComplexType
{
    /**
     * Name of this complex type
     *
     * @var string
     */
    protected $name = 'CompletedCodDetail';
    /**
     * Set CollectionAmount
     *
     * @param Money $collectionAmount
     * @return $this
     */
    public function setCollectionAmount(Money $collectionAmount)
    {
        $this->values['CollectionAmount'] = $collectionAmount;
        return $this;
    }
    /**
     * Set AdjustmentType
     *
     * @param \FedEx\UploadDocumentService\SimpleType\CodAdjustmentType|string $adjustmentType
     * @return $this
     */
    public function setAdjustmentType($adjustmentType)
    {
        $this->values['AdjustmentType'] = $adjustmentType;
        return $this;
    }
}
