<?php

namespace FedExVendor\FedEx\UploadDocumentService\SimpleType;

use FedExVendor\FedEx\AbstractSimpleType;
/**
 * Identifies an aspect of a shipment that may be paid separately.
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Upload Document Service
 */
class SplitPaymentType extends AbstractSimpleType
{
    const _APPOINTMENT_DELIVERY = 'APPOINTMENT_DELIVERY';
    const _PIECE_COUNT_VERIFICATION = 'PIECE_COUNT_VERIFICATION';
}
