<?php

namespace FedExVendor\FedEx\ShipService\SimpleType;

use FedExVendor\FedEx\AbstractSimpleType;
/**
 * CreditCardAuthorizationType
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Ship Service
 */
class CreditCardAuthorizationType extends AbstractSimpleType
{
    const _AUTHORIZE_NON_ACCOUNT = 'AUTHORIZE_NON_ACCOUNT';
    const _AUTHORIZE_WITH_ACCOUNT = 'AUTHORIZE_WITH_ACCOUNT';
    const _VERIFY_WITH_ACCOUNT = 'VERIFY_WITH_ACCOUNT';
}
