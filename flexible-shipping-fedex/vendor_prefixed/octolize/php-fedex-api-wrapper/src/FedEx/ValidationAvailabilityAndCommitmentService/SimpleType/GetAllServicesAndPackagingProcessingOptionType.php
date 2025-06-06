<?php

namespace FedExVendor\FedEx\ValidationAvailabilityAndCommitmentService\SimpleType;

use FedExVendor\FedEx\AbstractSimpleType;
/**
 * GetAllServicesAndPackagingProcessingOptionType
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Validation Availability And Commitment Service Service
 */
class GetAllServicesAndPackagingProcessingOptionType extends AbstractSimpleType
{
    const _EXCLUDE_ACCOUNT_ENABLEMENTS = 'EXCLUDE_ACCOUNT_ENABLEMENTS';
    const _EXCLUDE_CHANNEL_RESTRICTIONS = 'EXCLUDE_CHANNEL_RESTRICTIONS';
    const _EXCLUDE_EXTENDED_ACCOUNT_RULES = 'EXCLUDE_EXTENDED_ACCOUNT_RULES';
    const _EXCLUDE_GLOBAL_REGULATORY_RULES = 'EXCLUDE_GLOBAL_REGULATORY_RULES';
    const _EXCLUDE_INSURED_VALUE_RULES = 'EXCLUDE_INSURED_VALUE_RULES';
    const _EXCLUDE_RESTRICTIONS_AND_PRIVILEGES = 'EXCLUDE_RESTRICTIONS_AND_PRIVILEGES';
    const _EXCLUDE_WEIGHT_DIM_RULES = 'EXCLUDE_WEIGHT_DIM_RULES';
    const _WEIGHT_AND_DROPOFF_NOT_REQUIRED = 'WEIGHT_AND_DROPOFF_NOT_REQUIRED';
}
