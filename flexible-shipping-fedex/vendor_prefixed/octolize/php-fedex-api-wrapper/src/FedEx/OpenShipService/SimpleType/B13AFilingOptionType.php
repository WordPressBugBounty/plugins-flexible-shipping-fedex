<?php

namespace FedExVendor\FedEx\OpenShipService\SimpleType;

use FedExVendor\FedEx\AbstractSimpleType;
/**
 * B13AFilingOptionType
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  OpenShip Service
 */
class B13AFilingOptionType extends AbstractSimpleType
{
    const _FEDEX_TO_STAMP = 'FEDEX_TO_STAMP';
    const _FILED_ELECTRONICALLY = 'FILED_ELECTRONICALLY';
    const _MANUALLY_ATTACHED = 'MANUALLY_ATTACHED';
    const _NOT_REQUIRED = 'NOT_REQUIRED';
    const _SUMMARY_REPORTING = 'SUMMARY_REPORTING';
}
