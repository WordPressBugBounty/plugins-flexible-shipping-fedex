<?php

namespace FedExVendor\FedEx\UploadDocumentService\SimpleType;

use FedExVendor\FedEx\AbstractSimpleType;
/**
 * PageQuadrantType
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Upload Document Service
 */
class PageQuadrantType extends AbstractSimpleType
{
    const _BOTTOM_LEFT = 'BOTTOM_LEFT';
    const _BOTTOM_RIGHT = 'BOTTOM_RIGHT';
    const _TOP_LEFT = 'TOP_LEFT';
    const _TOP_RIGHT = 'TOP_RIGHT';
}
