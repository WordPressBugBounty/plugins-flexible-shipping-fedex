<?php

namespace FedExVendor\FedEx\OpenShipService\ComplexType;

use FedExVendor\FedEx\AbstractComplexType;
/**
 * ShipmentAdvisoryDetail
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  OpenShip Service
 *
 * @property RegulatoryAdvisoryDetail $RegulatoryAdvisory
 */
class ShipmentAdvisoryDetail extends AbstractComplexType
{
    /**
     * Name of this complex type
     *
     * @var string
     */
    protected $name = 'ShipmentAdvisoryDetail';
    /**
     * Set RegulatoryAdvisory
     *
     * @param RegulatoryAdvisoryDetail $regulatoryAdvisory
     * @return $this
     */
    public function setRegulatoryAdvisory(RegulatoryAdvisoryDetail $regulatoryAdvisory)
    {
        $this->values['RegulatoryAdvisory'] = $regulatoryAdvisory;
        return $this;
    }
}
