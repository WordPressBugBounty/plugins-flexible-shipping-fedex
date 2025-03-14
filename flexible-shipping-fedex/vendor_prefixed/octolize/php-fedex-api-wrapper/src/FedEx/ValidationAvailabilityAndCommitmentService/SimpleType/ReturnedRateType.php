<?php

namespace FedExVendor\FedEx\ValidationAvailabilityAndCommitmentService\SimpleType;

use FedExVendor\FedEx\AbstractSimpleType;
/**
 * The "PAYOR..." rates are expressed in the currency identified in the payor's rate table(s). The "RATED..." rates are expressed in the currency of the origin country. Former "...COUNTER..." values have become "...RETAIL..." values, except for PAYOR_COUNTER and RATED_COUNTER, which have been removed.
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Validation Availability And Commitment Service Service
 */
class ReturnedRateType extends AbstractSimpleType
{
    const _INCENTIVE = 'INCENTIVE';
    const _NEGOTIATED = 'NEGOTIATED';
    const _PAYOR_ACCOUNT_PACKAGE = 'PAYOR_ACCOUNT_PACKAGE';
    const _PAYOR_ACCOUNT_SHIPMENT = 'PAYOR_ACCOUNT_SHIPMENT';
    const _PAYOR_CUSTOM_PACKAGE = 'PAYOR_CUSTOM_PACKAGE';
    const _PAYOR_CUSTOM_SHIPMENT = 'PAYOR_CUSTOM_SHIPMENT';
    const _PAYOR_LIST_PACKAGE = 'PAYOR_LIST_PACKAGE';
    const _PAYOR_LIST_SHIPMENT = 'PAYOR_LIST_SHIPMENT';
    const _PAYOR_RETAIL_PACKAGE = 'PAYOR_RETAIL_PACKAGE';
    const _PAYOR_RETAIL_SHIPMENT = 'PAYOR_RETAIL_SHIPMENT';
    const _PREFERRED_ACCOUNT_PACKAGE = 'PREFERRED_ACCOUNT_PACKAGE';
    const _PREFERRED_ACCOUNT_SHIPMENT = 'PREFERRED_ACCOUNT_SHIPMENT';
    const _PREFERRED_CUSTOM_PACKAGE = 'PREFERRED_CUSTOM_PACKAGE';
    const _PREFERRED_CUSTOM_SHIPMENT = 'PREFERRED_CUSTOM_SHIPMENT';
    const _PREFERRED_INCENTIVE = 'PREFERRED_INCENTIVE';
    const _PREFERRED_LIST_PACKAGE = 'PREFERRED_LIST_PACKAGE';
    const _PREFERRED_LIST_SHIPMENT = 'PREFERRED_LIST_SHIPMENT';
    const _PREFERRED_NEGOTIATED = 'PREFERRED_NEGOTIATED';
    const _PREFERRED_RETAIL_PACKAGE = 'PREFERRED_RETAIL_PACKAGE';
    const _PREFERRED_RETAIL_SHIPMENT = 'PREFERRED_RETAIL_SHIPMENT';
    const _RATED_ACCOUNT_PACKAGE = 'RATED_ACCOUNT_PACKAGE';
    const _RATED_ACCOUNT_SHIPMENT = 'RATED_ACCOUNT_SHIPMENT';
    const _RATED_CUSTOM_PACKAGE = 'RATED_CUSTOM_PACKAGE';
    const _RATED_CUSTOM_SHIPMENT = 'RATED_CUSTOM_SHIPMENT';
    const _RATED_LIST_PACKAGE = 'RATED_LIST_PACKAGE';
    const _RATED_LIST_SHIPMENT = 'RATED_LIST_SHIPMENT';
    const _RATED_RETAIL_PACKAGE = 'RATED_RETAIL_PACKAGE';
    const _RATED_RETAIL_SHIPMENT = 'RATED_RETAIL_SHIPMENT';
}
