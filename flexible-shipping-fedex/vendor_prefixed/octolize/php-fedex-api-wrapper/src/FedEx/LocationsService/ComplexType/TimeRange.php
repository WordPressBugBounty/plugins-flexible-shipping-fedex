<?php

namespace FedExVendor\FedEx\LocationsService\ComplexType;

use FedExVendor\FedEx\AbstractComplexType;
/**
 * TimeRange
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Locations Service
 *
 * @property string $Begins
 * @property string $Ends
 */
class TimeRange extends AbstractComplexType
{
    /**
     * Name of this complex type
     *
     * @var string
     */
    protected $name = 'TimeRange';
    /**
     * Set Begins
     *
     * @param string $begins
     * @return $this
     */
    public function setBegins($begins)
    {
        $this->values['Begins'] = $begins;
        return $this;
    }
    /**
     * Set Ends
     *
     * @param string $ends
     * @return $this
     */
    public function setEnds($ends)
    {
        $this->values['Ends'] = $ends;
        return $this;
    }
}
