<?php

namespace FedExVendor\FedEx\UploadDocumentService\SimpleType;

use FedExVendor\FedEx\AbstractSimpleType;
/**
 * A regulation specific classification for a battery or cell.
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Upload Document Service
 */
class BatteryRegulatorySubType extends AbstractSimpleType
{
    const _IATA_SECTION_II = 'IATA_SECTION_II';
}
