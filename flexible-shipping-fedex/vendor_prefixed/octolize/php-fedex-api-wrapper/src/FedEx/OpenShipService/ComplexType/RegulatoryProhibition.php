<?php

namespace FedExVendor\FedEx\OpenShipService\ComplexType;

use FedExVendor\FedEx\AbstractComplexType;
/**
 * RegulatoryProhibition
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  OpenShip Service
 *
 * @property \FedEx\OpenShipService\SimpleType\ProhibitionStatusType|string $Status
 * @property \FedEx\OpenShipService\SimpleType\ProhibitionSourceType|string $Source
 * @property \FedEx\OpenShipService\SimpleType\ProhibitionType|string $Type
 * @property \FedEx\OpenShipService\SimpleType\ShipmentRuleType|string[] $Categories
 * @property int $CommodityIndex
 * @property string $DerivedHarmonizedCode
 * @property Message $Advisory
 * @property RegulatoryWaiver $Waiver
 */
class RegulatoryProhibition extends AbstractComplexType
{
    /**
     * Name of this complex type
     *
     * @var string
     */
    protected $name = 'RegulatoryProhibition';
    /**
     * Set Status
     *
     * @param \FedEx\OpenShipService\SimpleType\ProhibitionStatusType|string $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->values['Status'] = $status;
        return $this;
    }
    /**
     * Set Source
     *
     * @param \FedEx\OpenShipService\SimpleType\ProhibitionSourceType|string $source
     * @return $this
     */
    public function setSource($source)
    {
        $this->values['Source'] = $source;
        return $this;
    }
    /**
     * Set Type
     *
     * @param \FedEx\OpenShipService\SimpleType\ProhibitionType|string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->values['Type'] = $type;
        return $this;
    }
    /**
     * Set Categories
     *
     * @param \FedEx\OpenShipService\SimpleType\ShipmentRuleType[]|string[] $categories
     * @return $this
     */
    public function setCategories(array $categories)
    {
        $this->values['Categories'] = $categories;
        return $this;
    }
    /**
     * This is a 1-based index identifying the commodity in the request that resulted in this COMMODITY or DOCUMENT type prohibition.
     *
     * @param int $commodityIndex
     * @return $this
     */
    public function setCommodityIndex($commodityIndex)
    {
        $this->values['CommodityIndex'] = $commodityIndex;
        return $this;
    }
    /**
     * Set DerivedHarmonizedCode
     *
     * @param string $derivedHarmonizedCode
     * @return $this
     */
    public function setDerivedHarmonizedCode($derivedHarmonizedCode)
    {
        $this->values['DerivedHarmonizedCode'] = $derivedHarmonizedCode;
        return $this;
    }
    /**
     * Set Advisory
     *
     * @param Message $advisory
     * @return $this
     */
    public function setAdvisory(Message $advisory)
    {
        $this->values['Advisory'] = $advisory;
        return $this;
    }
    /**
     * Set Waiver
     *
     * @param RegulatoryWaiver $waiver
     * @return $this
     */
    public function setWaiver(RegulatoryWaiver $waiver)
    {
        $this->values['Waiver'] = $waiver;
        return $this;
    }
}
