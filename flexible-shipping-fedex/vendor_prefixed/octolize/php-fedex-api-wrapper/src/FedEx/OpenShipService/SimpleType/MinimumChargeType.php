<?php

namespace FedExVendor\FedEx\OpenShipService\SimpleType;

use FedExVendor\FedEx\AbstractSimpleType;
/**
 * MinimumChargeType
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  OpenShip Service
 */
class MinimumChargeType extends AbstractSimpleType
{
    const _CUSTOMER = 'CUSTOMER';
    const _CUSTOMER_FREIGHT_WEIGHT = 'CUSTOMER_FREIGHT_WEIGHT';
    const _EARNED_DISCOUNT = 'EARNED_DISCOUNT';
    const _MIXED = 'MIXED';
    const _RATE_SCALE = 'RATE_SCALE';
}
