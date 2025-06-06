<?php

namespace FedExVendor\FedEx\UploadDocumentService\SimpleType;

use FedExVendor\FedEx\AbstractSimpleType;
/**
 * Specifies the role that identifies the permissions the accessor of the pending shipment.
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Upload Document Service
 */
class AccessorRoleType extends AbstractSimpleType
{
    const _SHIPMENT_COMPLETOR = 'SHIPMENT_COMPLETOR';
    const _SHIPMENT_INITIATOR = 'SHIPMENT_INITIATOR';
}
