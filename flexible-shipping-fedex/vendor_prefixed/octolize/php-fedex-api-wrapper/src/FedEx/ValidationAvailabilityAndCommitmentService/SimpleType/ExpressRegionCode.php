<?php

namespace FedExVendor\FedEx\ValidationAvailabilityAndCommitmentService\SimpleType;

use FedExVendor\FedEx\AbstractSimpleType;
/**
 * Indicates a FedEx Express operating region.
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Validation Availability And Commitment Service Service
 */
class ExpressRegionCode extends AbstractSimpleType
{
    const _APAC = 'APAC';
    const _CA = 'CA';
    const _EMEA = 'EMEA';
    const _LAC = 'LAC';
    const _US = 'US';
}
