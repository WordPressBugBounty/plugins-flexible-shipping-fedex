<?php

namespace FedExVendor\FedEx\UploadDocumentService\SimpleType;

use FedExVendor\FedEx\AbstractSimpleType;
/**
 * RequirementType
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Upload Document Service
 */
class RequirementType extends AbstractSimpleType
{
    const _OPTIONAL = 'OPTIONAL';
    const _PROHIBITED = 'PROHIBITED';
    const _REQUIRED = 'REQUIRED';
}
