<?php

namespace FedExVendor\FedEx\ValidationAvailabilityAndCommitmentService\ComplexType;

use FedExVendor\FedEx\AbstractComplexType;
/**
 * This describes information about the inner receptacles for the hazardous commodity in a particular dangerous goods container.
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Validation Availability And Commitment Service Service
 *
 * @property HazardousCommodityQuantityDetail $Quantity
 */
class HazardousCommodityInnerReceptacleDetail extends AbstractComplexType
{
    /**
     * Name of this complex type
     *
     * @var string
     */
    protected $name = 'HazardousCommodityInnerReceptacleDetail';
    /**
     * This specifies the quantity contained in the inner receptacle.
     *
     * @param HazardousCommodityQuantityDetail $quantity
     * @return $this
     */
    public function setQuantity(HazardousCommodityQuantityDetail $quantity)
    {
        $this->values['Quantity'] = $quantity;
        return $this;
    }
}
