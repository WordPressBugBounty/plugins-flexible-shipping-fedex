<?php

namespace FedExVendor\FedEx\OpenShipService\SimpleType;

use FedExVendor\FedEx\AbstractSimpleType;
/**
 * AssociatedShipmentType
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  OpenShip Service
 */
class AssociatedShipmentType extends AbstractSimpleType
{
    const _COD_AND_DELIVERY_ON_INVOICE_ACCEPTANCE_RETURN = 'COD_AND_DELIVERY_ON_INVOICE_ACCEPTANCE_RETURN';
    const _COD_RETURN = 'COD_RETURN';
    const _DELIVERY_ON_INVOICE_ACCEPTANCE_RETURN = 'DELIVERY_ON_INVOICE_ACCEPTANCE_RETURN';
}
