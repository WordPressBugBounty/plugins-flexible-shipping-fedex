<?php

namespace FedExVendor\FedEx\UploadDocumentService\SimpleType;

use FedExVendor\FedEx\AbstractSimpleType;
/**
 * HazardousCommodityAttributeType
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Upload Document Service
 */
class HazardousCommodityAttributeType extends AbstractSimpleType
{
    const _NOT_SUBJECT_TO_REGULATIONS = 'NOT_SUBJECT_TO_REGULATIONS';
    const _PLACARDED_VEHICLE_REQUIRED = 'PLACARDED_VEHICLE_REQUIRED';
}
