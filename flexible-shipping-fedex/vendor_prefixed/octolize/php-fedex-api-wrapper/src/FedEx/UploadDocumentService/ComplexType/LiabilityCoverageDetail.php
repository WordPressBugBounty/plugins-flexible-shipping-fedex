<?php

namespace FedExVendor\FedEx\UploadDocumentService\ComplexType;

use FedExVendor\FedEx\AbstractComplexType;
/**
 * LiabilityCoverageDetail
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Upload Document Service
 *
 * @property \FedEx\UploadDocumentService\SimpleType\LiabilityCoverageType|string $CoverageType
 * @property Money $CoverageAmount
 */
class LiabilityCoverageDetail extends \FedExVendor\FedEx\AbstractComplexType
{
    /**
     * Name of this complex type
     *
     * @var string
     */
    protected $name = 'LiabilityCoverageDetail';
    /**
     * Set CoverageType
     *
     * @param \FedEx\UploadDocumentService\SimpleType\LiabilityCoverageType|string $coverageType
     * @return $this
     */
    public function setCoverageType($coverageType)
    {
        $this->values['CoverageType'] = $coverageType;
        return $this;
    }
    /**
     * Identifies the Liability Coverage Amount. For Jan 2010 this value represents coverage amount per pound
     *
     * @param Money $coverageAmount
     * @return $this
     */
    public function setCoverageAmount(\FedExVendor\FedEx\UploadDocumentService\ComplexType\Money $coverageAmount)
    {
        $this->values['CoverageAmount'] = $coverageAmount;
        return $this;
    }
}