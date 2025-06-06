<?php

namespace FedExVendor\FedEx\ValidationAvailabilityAndCommitmentService\ComplexType;

use FedExVendor\FedEx\AbstractComplexType;
/**
 * HomeDeliveryPremiumDetail
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Validation Availability And Commitment Service Service
 *
 * @property \FedEx\ValidationAvailabilityAndCommitmentService\SimpleType\HomeDeliveryPremiumType|string $HomeDeliveryPremiumType
 * @property string $Date
 * @property string $PhoneNumber
 */
class HomeDeliveryPremiumDetail extends AbstractComplexType
{
    /**
     * Name of this complex type
     *
     * @var string
     */
    protected $name = 'HomeDeliveryPremiumDetail';
    /**
     * Set HomeDeliveryPremiumType
     *
     * @param \FedEx\ValidationAvailabilityAndCommitmentService\SimpleType\HomeDeliveryPremiumType|string $homeDeliveryPremiumType
     * @return $this
     */
    public function setHomeDeliveryPremiumType($homeDeliveryPremiumType)
    {
        $this->values['HomeDeliveryPremiumType'] = $homeDeliveryPremiumType;
        return $this;
    }
    /**
     * Set Date
     *
     * @param string $date
     * @return $this
     */
    public function setDate($date)
    {
        $this->values['Date'] = $date;
        return $this;
    }
    /**
     * Set PhoneNumber
     *
     * @param string $phoneNumber
     * @return $this
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->values['PhoneNumber'] = $phoneNumber;
        return $this;
    }
}
