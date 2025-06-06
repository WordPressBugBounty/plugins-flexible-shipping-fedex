<?php

namespace FedExVendor\FedEx\UploadDocumentService\SimpleType;

use FedExVendor\FedEx\AbstractSimpleType;
/**
 * CodAddTransportationChargeBasisType
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Upload Document Service
 */
class CodAddTransportationChargeBasisType extends AbstractSimpleType
{
    const _COD_SURCHARGE = 'COD_SURCHARGE';
    const _NET_CHARGE = 'NET_CHARGE';
    const _NET_FREIGHT = 'NET_FREIGHT';
    const _TOTAL_CUSTOMER_CHARGE = 'TOTAL_CUSTOMER_CHARGE';
}
