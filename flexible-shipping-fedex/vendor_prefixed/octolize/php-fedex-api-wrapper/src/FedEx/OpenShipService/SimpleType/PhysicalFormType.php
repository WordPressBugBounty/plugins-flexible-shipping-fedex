<?php

namespace FedExVendor\FedEx\OpenShipService\SimpleType;

use FedExVendor\FedEx\AbstractSimpleType;
/**
 * PhysicalFormType
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  OpenShip Service
 */
class PhysicalFormType extends AbstractSimpleType
{
    const _GAS = 'GAS';
    const _LIQUID = 'LIQUID';
    const _SOLID = 'SOLID';
    const _SPECIAL = 'SPECIAL';
}
