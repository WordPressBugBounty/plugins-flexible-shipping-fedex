<?php

namespace FedExVendor\FedEx\PickupService\SimpleType;

use FedExVendor\FedEx\AbstractSimpleType;
/**
 * Specifies whether to confirm documents prior to processing a shipment with the ELECTRONIC_TRADE_DOCUMENTS special service.
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Pickup Service
 */
class EtdConfirmationType extends AbstractSimpleType
{
    const _CONFIRMED = 'CONFIRMED';
    const _DEFERRED = 'DEFERRED';
}
