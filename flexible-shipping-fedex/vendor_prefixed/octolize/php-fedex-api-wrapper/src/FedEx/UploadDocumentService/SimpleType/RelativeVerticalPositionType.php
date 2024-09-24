<?php

namespace FedExVendor\FedEx\UploadDocumentService\SimpleType;

use FedExVendor\FedEx\AbstractSimpleType;
/**
 * Describes the vertical position of an item relative to another item.
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Upload Document Service
 */
class RelativeVerticalPositionType extends \FedExVendor\FedEx\AbstractSimpleType
{
    const _ABOVE = 'ABOVE';
    const _BELOW = 'BELOW';
}
