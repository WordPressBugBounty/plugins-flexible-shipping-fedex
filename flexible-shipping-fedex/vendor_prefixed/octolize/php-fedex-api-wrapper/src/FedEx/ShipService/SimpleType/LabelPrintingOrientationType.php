<?php

namespace FedExVendor\FedEx\ShipService\SimpleType;

use FedExVendor\FedEx\AbstractSimpleType;
/**
 * LabelPrintingOrientationType
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Ship Service
 */
class LabelPrintingOrientationType extends AbstractSimpleType
{
    const _BOTTOM_EDGE_OF_TEXT_FIRST = 'BOTTOM_EDGE_OF_TEXT_FIRST';
    const _TOP_EDGE_OF_TEXT_FIRST = 'TOP_EDGE_OF_TEXT_FIRST';
}
