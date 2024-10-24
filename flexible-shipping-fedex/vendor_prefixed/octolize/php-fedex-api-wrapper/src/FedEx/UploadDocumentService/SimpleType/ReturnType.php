<?php

namespace FedExVendor\FedEx\UploadDocumentService\SimpleType;

use FedExVendor\FedEx\AbstractSimpleType;
/**
 * ReturnType
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Upload Document Service
 */
class ReturnType extends AbstractSimpleType
{
    const _FEDEX_TAG = 'FEDEX_TAG';
    const _NET_RETURN = 'NET_RETURN';
    const _PENDING = 'PENDING';
    const _PRINT_RETURN_LABEL = 'PRINT_RETURN_LABEL';
    const _VOICE_CALL_TAG = 'VOICE_CALL_TAG';
}
