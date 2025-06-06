<?php

namespace FedExVendor\FedEx\ValidationAvailabilityAndCommitmentService\ComplexType;

use FedExVendor\FedEx\AbstractComplexType;
/**
 * Supporting detail for applied options identified in a rate quote.
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Validation Availability And Commitment Service Service
 *
 * @property \FedEx\ValidationAvailabilityAndCommitmentService\SimpleType\FreightGuaranteeType|string $FreightGuarantee
 * @property string $SmartPostHubId
 * @property \FedEx\ValidationAvailabilityAndCommitmentService\SimpleType\SmartPostIndiciaType|string $SmartPostIndicia
 */
class ServiceSubOptionDetail extends AbstractComplexType
{
    /**
     * Name of this complex type
     *
     * @var string
     */
    protected $name = 'ServiceSubOptionDetail';
    /**
     * Identifies the type of Freight Guarantee applied, if FREIGHT_GUARANTEE is applied to the rate quote.
     *
     * @param \FedEx\ValidationAvailabilityAndCommitmentService\SimpleType\FreightGuaranteeType|string $freightGuarantee
     * @return $this
     */
    public function setFreightGuarantee($freightGuarantee)
    {
        $this->values['FreightGuarantee'] = $freightGuarantee;
        return $this;
    }
    /**
     * Identifies the smartPostHubId used during rate quote, if SMART_POST_HUB_ID is a variable option on the rate request.
     *
     * @param string $smartPostHubId
     * @return $this
     */
    public function setSmartPostHubId($smartPostHubId)
    {
        $this->values['SmartPostHubId'] = $smartPostHubId;
        return $this;
    }
    /**
     * Identifies the indicia used during rate quote, if SMART_POST_ALLOWED_INDICIA is a variable option on the rate request.
     *
     * @param \FedEx\ValidationAvailabilityAndCommitmentService\SimpleType\SmartPostIndiciaType|string $smartPostIndicia
     * @return $this
     */
    public function setSmartPostIndicia($smartPostIndicia)
    {
        $this->values['SmartPostIndicia'] = $smartPostIndicia;
        return $this;
    }
}
