<?php

namespace FedExVendor\FedEx\ValidationAvailabilityAndCommitmentService\ComplexType;

use FedExVendor\FedEx\AbstractComplexType;
/**
 * ExpressFreightDetailContact
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Validation Availability And Commitment Service Service
 *
 * @property string $Name
 * @property string $Phone
 */
class ExpressFreightDetailContact extends AbstractComplexType
{
    /**
     * Name of this complex type
     *
     * @var string
     */
    protected $name = 'ExpressFreightDetailContact';
    /**
     * Set Name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->values['Name'] = $name;
        return $this;
    }
    /**
     * Set Phone
     *
     * @param string $phone
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->values['Phone'] = $phone;
        return $this;
    }
}
