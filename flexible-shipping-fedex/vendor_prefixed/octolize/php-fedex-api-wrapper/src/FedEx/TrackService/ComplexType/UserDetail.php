<?php

namespace FedExVendor\FedEx\TrackService\ComplexType;

use FedExVendor\FedEx\AbstractComplexType;
/**
 * UserDetail
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Package Movement Information Service
 *
 * @property string $UserId
 * @property string $Password
 * @property string $UniqueUserId
 */
class UserDetail extends AbstractComplexType
{
    /**
     * Name of this complex type
     *
     * @var string
     */
    protected $name = 'UserDetail';
    /**
     * Set UserId
     *
     * @param string $userId
     * @return $this
     */
    public function setUserId($userId)
    {
        $this->values['UserId'] = $userId;
        return $this;
    }
    /**
     * Set Password
     *
     * @param string $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->values['Password'] = $password;
        return $this;
    }
    /**
     * Set UniqueUserId
     *
     * @param string $uniqueUserId
     * @return $this
     */
    public function setUniqueUserId($uniqueUserId)
    {
        $this->values['UniqueUserId'] = $uniqueUserId;
        return $this;
    }
}
