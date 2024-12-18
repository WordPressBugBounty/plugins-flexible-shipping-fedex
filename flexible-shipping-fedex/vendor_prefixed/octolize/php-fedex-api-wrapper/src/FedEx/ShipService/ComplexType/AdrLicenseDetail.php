<?php

namespace FedExVendor\FedEx\ShipService\ComplexType;

use FedExVendor\FedEx\AbstractComplexType;
/**
 * Specifies the details around the ADR license required for shipping.
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Ship Service
 *
 * @property LicenseOrPermitDetail $LicenseOrPermitDetail
 */
class AdrLicenseDetail extends AbstractComplexType
{
    /**
     * Name of this complex type
     *
     * @var string
     */
    protected $name = 'AdrLicenseDetail';
    /**
     * Set LicenseOrPermitDetail
     *
     * @param LicenseOrPermitDetail $licenseOrPermitDetail
     * @return $this
     */
    public function setLicenseOrPermitDetail(LicenseOrPermitDetail $licenseOrPermitDetail)
    {
        $this->values['LicenseOrPermitDetail'] = $licenseOrPermitDetail;
        return $this;
    }
}
