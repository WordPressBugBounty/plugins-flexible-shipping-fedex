<?php

namespace FedExVendor\FedEx\OpenShipService\SimpleType;

use FedExVendor\FedEx\AbstractSimpleType;
/**
 * ShipmentNotificationAggregationType
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  OpenShip Service
 */
class ShipmentNotificationAggregationType extends AbstractSimpleType
{
    const _PER_PACKAGE = 'PER_PACKAGE';
    const _PER_SHIPMENT = 'PER_SHIPMENT';
}
