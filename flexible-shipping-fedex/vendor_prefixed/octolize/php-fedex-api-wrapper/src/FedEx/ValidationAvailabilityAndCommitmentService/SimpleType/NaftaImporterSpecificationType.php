<?php

namespace FedExVendor\FedEx\ValidationAvailabilityAndCommitmentService\SimpleType;

use FedExVendor\FedEx\AbstractSimpleType;
/**
 * NaftaImporterSpecificationType
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Validation Availability And Commitment Service Service
 */
class NaftaImporterSpecificationType extends AbstractSimpleType
{
    const _IMPORTER_OF_RECORD = 'IMPORTER_OF_RECORD';
    const _RECIPIENT = 'RECIPIENT';
    const _UNKNOWN = 'UNKNOWN';
    const _VARIOUS = 'VARIOUS';
}
