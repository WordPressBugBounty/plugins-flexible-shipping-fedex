<?php

namespace FedExVendor\FedEx\UploadDocumentService\SimpleType;

use FedExVendor\FedEx\AbstractSimpleType;
/**
 * Specifies the type of license that the recipient of the alcohol shipment has.
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Upload Document Service
 */
class AlcoholRecipientType extends AbstractSimpleType
{
    const _CONSUMER = 'CONSUMER';
    const _LICENSEE = 'LICENSEE';
}
