<?php

namespace FedExVendor\FedEx\ValidationAvailabilityAndCommitmentService\ComplexType;

use FedExVendor\FedEx\AbstractComplexType;
/**
 * PackagingDescription
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Validation Availability And Commitment Service Service
 *
 * @property string $PackagingId
 * @property string $PackagingType
 * @property string $Code
 * @property ProductName[] $Names
 * @property string $Description
 * @property string $AstraDescription
 */
class PackagingDescription extends AbstractComplexType
{
    /**
     * Name of this complex type
     *
     * @var string
     */
    protected $name = 'PackagingDescription';
    /**
     * FOR FEDEX INTERNAL USE ONLY: Designates the packaging ID.
     *
     * @param string $packagingId
     * @return $this
     */
    public function setPackagingId($packagingId)
    {
        $this->values['PackagingId'] = $packagingId;
        return $this;
    }
    /**
     * Set PackagingType
     *
     * @param string $packagingType
     * @return $this
     */
    public function setPackagingType($packagingType)
    {
        $this->values['PackagingType'] = $packagingType;
        return $this;
    }
    /**
     * Set Code
     *
     * @param string $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->values['Code'] = $code;
        return $this;
    }
    /**
     * Branded, translated, and/or localized names for this packaging.
     *
     * @param ProductName[] $names
     * @return $this
     */
    public function setNames(array $names)
    {
        $this->values['Names'] = $names;
        return $this;
    }
    /**
     * Set Description
     *
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->values['Description'] = $description;
        return $this;
    }
    /**
     * Set AstraDescription
     *
     * @param string $astraDescription
     * @return $this
     */
    public function setAstraDescription($astraDescription)
    {
        $this->values['AstraDescription'] = $astraDescription;
        return $this;
    }
}
