<?php

namespace FedExVendor\FedEx\ShipService\SimpleType;

use FedExVendor\FedEx\AbstractSimpleType;
/**
 * SurchargeLevelType
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Ship Service
 */
class SurchargeLevelType extends AbstractSimpleType
{
    const _PACKAGE = 'PACKAGE';
    const _SHIPMENT = 'SHIPMENT';
}
