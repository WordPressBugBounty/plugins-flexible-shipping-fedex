<?php

namespace FedExVendor\FedEx\UploadDocumentService\SimpleType;

use FedExVendor\FedEx\AbstractSimpleType;
/**
 * CustomDeliveryWindowType
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Upload Document Service
 */
class CustomDeliveryWindowType extends AbstractSimpleType
{
    const _AFTER = 'AFTER';
    const _BEFORE = 'BEFORE';
    const _BETWEEN = 'BETWEEN';
    const _ON = 'ON';
}
