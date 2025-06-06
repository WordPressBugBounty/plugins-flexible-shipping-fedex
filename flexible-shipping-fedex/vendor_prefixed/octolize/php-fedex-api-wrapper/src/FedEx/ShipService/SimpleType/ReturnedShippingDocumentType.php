<?php

namespace FedExVendor\FedEx\ShipService\SimpleType;

use FedExVendor\FedEx\AbstractSimpleType;
/**
 * ReturnedShippingDocumentType
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Ship Service
 */
class ReturnedShippingDocumentType extends AbstractSimpleType
{
    const _AUXILIARY_LABEL = 'AUXILIARY_LABEL';
    const _CERTIFICATE_OF_ORIGIN = 'CERTIFICATE_OF_ORIGIN';
    const _COD_AND_DELIVERY_ON_INVOICE_ACCEPTANCE_RETURN_2_D_BARCODE = 'COD_AND_DELIVERY_ON_INVOICE_ACCEPTANCE_RETURN_2_D_BARCODE';
    const _COD_AND_DELIVERY_ON_INVOICE_ACCEPTANCE_RETURN_LABEL = 'COD_AND_DELIVERY_ON_INVOICE_ACCEPTANCE_RETURN_LABEL';
    const _COD_RETURN_2_D_BARCODE = 'COD_RETURN_2_D_BARCODE';
    const _COD_RETURN_LABEL = 'COD_RETURN_LABEL';
    const _COMMERCIAL_INVOICE = 'COMMERCIAL_INVOICE';
    const _CUSTOM_PACKAGE_DOCUMENT = 'CUSTOM_PACKAGE_DOCUMENT';
    const _CUSTOM_SHIPMENT_DOCUMENT = 'CUSTOM_SHIPMENT_DOCUMENT';
    const _DANGEROUS_GOODS_SHIPPERS_DECLARATION = 'DANGEROUS_GOODS_SHIPPERS_DECLARATION';
    const _DELIVERY_ON_INVOICE_ACCEPTANCE_RETURN_2_D_BARCODE = 'DELIVERY_ON_INVOICE_ACCEPTANCE_RETURN_2_D_BARCODE';
    const _DELIVERY_ON_INVOICE_ACCEPTANCE_RETURN_LABEL = 'DELIVERY_ON_INVOICE_ACCEPTANCE_RETURN_LABEL';
    const _ETD_LABEL = 'ETD_LABEL';
    const _EXPORT_DECLARATION = 'EXPORT_DECLARATION';
    const _FEDEX_FREIGHT_STRAIGHT_BILL_OF_LADING = 'FEDEX_FREIGHT_STRAIGHT_BILL_OF_LADING';
    const _FREIGHT_ADDRESS_LABEL = 'FREIGHT_ADDRESS_LABEL';
    const _GENERAL_AGENCY_AGREEMENT = 'GENERAL_AGENCY_AGREEMENT';
    const _GROUND_BARCODE = 'GROUND_BARCODE';
    const _OP_900 = 'OP_900';
    const _OUTBOUND_2_D_BARCODE = 'OUTBOUND_2_D_BARCODE';
    const _OUTBOUND_LABEL = 'OUTBOUND_LABEL';
    const _PRO_FORMA_INVOICE = 'PRO_FORMA_INVOICE';
    const _RECIPIENT_ADDRESS_BARCODE = 'RECIPIENT_ADDRESS_BARCODE';
    const _RECIPIENT_POSTAL_BARCODE = 'RECIPIENT_POSTAL_BARCODE';
    const _RETURN_INSTRUCTIONS = 'RETURN_INSTRUCTIONS';
    const _TERMS_AND_CONDITIONS = 'TERMS_AND_CONDITIONS';
    const _USMCA_CERTIFICATION_OF_ORIGIN = 'USMCA_CERTIFICATION_OF_ORIGIN';
    const _USMCA_COMMERCIAL_INVOICE_CERTIFICATION_OF_ORIGIN = 'USMCA_COMMERCIAL_INVOICE_CERTIFICATION_OF_ORIGIN';
    const _USPS_BARCODE = 'USPS_BARCODE';
    const _VICS_BILL_OF_LADING = 'VICS_BILL_OF_LADING';
}
