<?php

namespace FedExVendor\FedEx\TrackService\ComplexType;

use FedExVendor\FedEx\AbstractComplexType;
/**
 * NaftaCommodityDetail
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Package Movement Information Service
 *
 * @property \FedEx\TrackService\SimpleType\NaftaPreferenceCriterionCode|string $PreferenceCriterion
 * @property \FedEx\TrackService\SimpleType\NaftaProducerDeterminationCode|string $ProducerDetermination
 * @property string $ProducerId
 * @property \FedEx\TrackService\SimpleType\NaftaNetCostMethodCode|string $NetCostMethod
 * @property DateRange $NetCostDateRange
 */
class NaftaCommodityDetail extends AbstractComplexType
{
    /**
     * Name of this complex type
     *
     * @var string
     */
    protected $name = 'NaftaCommodityDetail';
    /**
     * Defined by NAFTA regulations.
     *
     * @param \FedEx\TrackService\SimpleType\NaftaPreferenceCriterionCode|string $preferenceCriterion
     * @return $this
     */
    public function setPreferenceCriterion($preferenceCriterion)
    {
        $this->values['PreferenceCriterion'] = $preferenceCriterion;
        return $this;
    }
    /**
     * Defined by NAFTA regulations.
     *
     * @param \FedEx\TrackService\SimpleType\NaftaProducerDeterminationCode|string $producerDetermination
     * @return $this
     */
    public function setProducerDetermination($producerDetermination)
    {
        $this->values['ProducerDetermination'] = $producerDetermination;
        return $this;
    }
    /**
     * Identification of which producer is associated with this commodity (if multiple producers are used in a single shipment).
     *
     * @param string $producerId
     * @return $this
     */
    public function setProducerId($producerId)
    {
        $this->values['ProducerId'] = $producerId;
        return $this;
    }
    /**
     * Set NetCostMethod
     *
     * @param \FedEx\TrackService\SimpleType\NaftaNetCostMethodCode|string $netCostMethod
     * @return $this
     */
    public function setNetCostMethod($netCostMethod)
    {
        $this->values['NetCostMethod'] = $netCostMethod;
        return $this;
    }
    /**
     * Date range over which RVC net cost was calculated.
     *
     * @param DateRange $netCostDateRange
     * @return $this
     */
    public function setNetCostDateRange(DateRange $netCostDateRange)
    {
        $this->values['NetCostDateRange'] = $netCostDateRange;
        return $this;
    }
}
