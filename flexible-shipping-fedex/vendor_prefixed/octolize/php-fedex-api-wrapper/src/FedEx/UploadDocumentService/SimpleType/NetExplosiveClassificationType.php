<?php

namespace FedExVendor\FedEx\UploadDocumentService\SimpleType;

use FedExVendor\FedEx\AbstractSimpleType;
/**
 * NetExplosiveClassificationType
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Upload Document Service
 */
class NetExplosiveClassificationType extends AbstractSimpleType
{
    const _NET_EXPLOSIVE_CONTENT = 'NET_EXPLOSIVE_CONTENT';
    const _NET_EXPLOSIVE_MASS = 'NET_EXPLOSIVE_MASS';
    const _NET_EXPLOSIVE_QUANTITY = 'NET_EXPLOSIVE_QUANTITY';
    const _NET_EXPLOSIVE_WEIGHT = 'NET_EXPLOSIVE_WEIGHT';
}
