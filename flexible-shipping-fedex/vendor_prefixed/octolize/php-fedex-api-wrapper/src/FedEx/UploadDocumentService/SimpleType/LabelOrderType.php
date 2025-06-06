<?php

namespace FedExVendor\FedEx\UploadDocumentService\SimpleType;

use FedExVendor\FedEx\AbstractSimpleType;
/**
 * Specifies the order in which the labels will be returned
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Upload Document Service
 */
class LabelOrderType extends AbstractSimpleType
{
    const _SHIPPING_LABEL_FIRST = 'SHIPPING_LABEL_FIRST';
    const _SHIPPING_LABEL_LAST = 'SHIPPING_LABEL_LAST';
}
