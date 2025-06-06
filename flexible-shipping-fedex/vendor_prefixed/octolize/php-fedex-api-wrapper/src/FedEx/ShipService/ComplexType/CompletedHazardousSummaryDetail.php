<?php

namespace FedExVendor\FedEx\ShipService\ComplexType;

use FedExVendor\FedEx\AbstractComplexType;
/**
 * CompletedHazardousSummaryDetail
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Ship Service
 *
 * @property int $SmallQuantityExceptionPackageCount
 */
class CompletedHazardousSummaryDetail extends AbstractComplexType
{
    /**
     * Name of this complex type
     *
     * @var string
     */
    protected $name = 'CompletedHazardousSummaryDetail';
    /**
     * Specifies the total number of packages containing hazardous commodities in small exceptions.
     *
     * @param int $smallQuantityExceptionPackageCount
     * @return $this
     */
    public function setSmallQuantityExceptionPackageCount($smallQuantityExceptionPackageCount)
    {
        $this->values['SmallQuantityExceptionPackageCount'] = $smallQuantityExceptionPackageCount;
        return $this;
    }
}
