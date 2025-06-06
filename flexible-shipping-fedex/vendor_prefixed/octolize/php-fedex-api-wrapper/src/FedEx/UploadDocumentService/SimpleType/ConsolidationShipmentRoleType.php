<?php

namespace FedExVendor\FedEx\UploadDocumentService\SimpleType;

use FedExVendor\FedEx\AbstractSimpleType;
/**
 * ConsolidationShipmentRoleType
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Upload Document Service
 */
class ConsolidationShipmentRoleType extends AbstractSimpleType
{
    const _CONSOLIDATION_DOCUMENTS_SHIPMENT = 'CONSOLIDATION_DOCUMENTS_SHIPMENT';
    const _CRN_SHIPMENT = 'CRN_SHIPMENT';
    const _MASTER_AIRWAYBILL_SHIPMENT = 'MASTER_AIRWAYBILL_SHIPMENT';
}
