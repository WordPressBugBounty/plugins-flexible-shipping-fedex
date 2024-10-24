<?php

namespace FedExVendor\FedEx\TrackService\SimpleType;

use FedExVendor\FedEx\AbstractSimpleType;
/**
 * TrackSpecialHandlingType
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Package Movement Information Service
 */
class TrackSpecialHandlingType extends AbstractSimpleType
{
    const _ACCESSIBLE_DANGEROUS_GOODS = 'ACCESSIBLE_DANGEROUS_GOODS';
    const _ADULT_SIGNATURE_OPTION = 'ADULT_SIGNATURE_OPTION';
    const _AIRBILL_AUTOMATION = 'AIRBILL_AUTOMATION';
    const _AIRBILL_DELIVERY = 'AIRBILL_DELIVERY';
    const _ALCOHOL = 'ALCOHOL';
    const _AM_DELIVERY_GUARANTEE = 'AM_DELIVERY_GUARANTEE';
    const _APPOINTMENT_DELIVERY = 'APPOINTMENT_DELIVERY';
    const _BATTERY = 'BATTERY';
    const _BILL_RECIPIENT = 'BILL_RECIPIENT';
    const _BROKER_SELECT_OPTION = 'BROKER_SELECT_OPTION';
    const _CALL_BEFORE_DELIVERY = 'CALL_BEFORE_DELIVERY';
    const _CALL_TAG = 'CALL_TAG';
    const _CALL_TAG_DAMAGE = 'CALL_TAG_DAMAGE';
    const _CHARGEABLE_CODE = 'CHARGEABLE_CODE';
    const _COD = 'COD';
    const _COLLECT = 'COLLECT';
    const _CONSOLIDATION = 'CONSOLIDATION';
    const _CONSOLIDATION_SMALLS_BAG = 'CONSOLIDATION_SMALLS_BAG';
    const _CURRENCY = 'CURRENCY';
    const _CUT_FLOWERS = 'CUT_FLOWERS';
    const _DATE_CERTAIN_DELIVERY = 'DATE_CERTAIN_DELIVERY';
    const _DELIVERY_ON_INVOICE_ACCEPTANCE = 'DELIVERY_ON_INVOICE_ACCEPTANCE';
    const _DELIVERY_REATTEMPT = 'DELIVERY_REATTEMPT';
    const _DELIVERY_RECEIPT = 'DELIVERY_RECEIPT';
    const _DELIVER_WEEKDAY = 'DELIVER_WEEKDAY';
    const _DIRECT_SIGNATURE_OPTION = 'DIRECT_SIGNATURE_OPTION';
    const _DOMESTIC = 'DOMESTIC';
    const _DO_NOT_BREAK_DOWN_PALLETS = 'DO_NOT_BREAK_DOWN_PALLETS';
    const _DO_NOT_STACK_PALLETS = 'DO_NOT_STACK_PALLETS';
    const _DRY_ICE = 'DRY_ICE';
    const _DRY_ICE_ADDED = 'DRY_ICE_ADDED';
    const _EAST_COAST_SPECIAL = 'EAST_COAST_SPECIAL';
    const _ELECTRONIC_COD = 'ELECTRONIC_COD';
    const _ELECTRONIC_DOCUMENTS_WITH_ORIGINALS = 'ELECTRONIC_DOCUMENTS_WITH_ORIGINALS';
    const _ELECTRONIC_SIGNATURE_SERVICE = 'ELECTRONIC_SIGNATURE_SERVICE';
    const _ELECTRONIC_TRADE_DOCUMENTS = 'ELECTRONIC_TRADE_DOCUMENTS';
    const _EVENING_DELIVERY = 'EVENING_DELIVERY';
    const _EXCLUSIVE_USE = 'EXCLUSIVE_USE';
    const _EXTENDED_DELIVERY = 'EXTENDED_DELIVERY';
    const _EXTENDED_PICKUP = 'EXTENDED_PICKUP';
    const _EXTRA_LABOR = 'EXTRA_LABOR';
    const _EXTREME_LENGTH = 'EXTREME_LENGTH';
    const _FOOD = 'FOOD';
    const _FREIGHT_ON_VALUE_CARRIER_RISK = 'FREIGHT_ON_VALUE_CARRIER_RISK';
    const _FREIGHT_ON_VALUE_OWN_RISK = 'FREIGHT_ON_VALUE_OWN_RISK';
    const _FREIGHT_TO_COLLECT = 'FREIGHT_TO_COLLECT';
    const _FULLY_REGULATED_DANGEROUS_GOODS = 'FULLY_REGULATED_DANGEROUS_GOODS';
    const _GEL_PACKS_ADDED_OR_REPLACED = 'GEL_PACKS_ADDED_OR_REPLACED';
    const _GROUND_SUPPORT_FOR_SMARTPOST = 'GROUND_SUPPORT_FOR_SMARTPOST';
    const _GUARANTEED_FUNDS = 'GUARANTEED_FUNDS';
    const _HAZMAT = 'HAZMAT';
    const _HIGH_FLOOR = 'HIGH_FLOOR';
    const _HOLD_AT_LOCATION = 'HOLD_AT_LOCATION';
    const _HOLIDAY_DELIVERY = 'HOLIDAY_DELIVERY';
    const _INACCESSIBLE_DANGEROUS_GOODS = 'INACCESSIBLE_DANGEROUS_GOODS';
    const _INDIRECT_SIGNATURE_OPTION = 'INDIRECT_SIGNATURE_OPTION';
    const _INSIDE_DELIVERY = 'INSIDE_DELIVERY';
    const _INSIDE_PICKUP = 'INSIDE_PICKUP';
    const _INTERNATIONAL = 'INTERNATIONAL';
    const _INTERNATIONAL_CONTROLLED_EXPORT = 'INTERNATIONAL_CONTROLLED_EXPORT';
    const _INTERNATIONAL_MAIL_SERVICE = 'INTERNATIONAL_MAIL_SERVICE';
    const _INTERNATIONAL_TRAFFIC_IN_ARMS_REGULATIONS = 'INTERNATIONAL_TRAFFIC_IN_ARMS_REGULATIONS';
    const _LIFTGATE = 'LIFTGATE';
    const _LIFTGATE_DELIVERY = 'LIFTGATE_DELIVERY';
    const _LIFTGATE_PICKUP = 'LIFTGATE_PICKUP';
    const _LIMITED_ACCESS_DELIVERY = 'LIMITED_ACCESS_DELIVERY';
    const _LIMITED_ACCESS_PICKUP = 'LIMITED_ACCESS_PICKUP';
    const _LIMITED_QUANTITIES_DANGEROUS_GOODS = 'LIMITED_QUANTITIES_DANGEROUS_GOODS';
    const _MARKING_OR_TAGGING = 'MARKING_OR_TAGGING';
    const _NET_RETURN = 'NET_RETURN';
    const _NON_BUSINESS_TIME = 'NON_BUSINESS_TIME';
    const _NON_STANDARD_CONTAINER = 'NON_STANDARD_CONTAINER';
    const _NO_SIGNATURE_REQUIRED_SIGNATURE_OPTION = 'NO_SIGNATURE_REQUIRED_SIGNATURE_OPTION';
    const _ORDER_NOTIFY = 'ORDER_NOTIFY';
    const _OTHER = 'OTHER';
    const _OTHER_REGULATED_MATERIAL_DOMESTIC = 'OTHER_REGULATED_MATERIAL_DOMESTIC';
    const _OVER_LENGTH = 'OVER_LENGTH';
    const _PACKAGE_RETURN_PROGRAM = 'PACKAGE_RETURN_PROGRAM';
    const _PIECE_COUNT_VERIFICATION = 'PIECE_COUNT_VERIFICATION';
    const _POISON = 'POISON';
    const _PREPAID = 'PREPAID';
    const _PRIORITY_ALERT = 'PRIORITY_ALERT';
    const _PRIORITY_ALERT_PLUS = 'PRIORITY_ALERT_PLUS';
    const _PROTECTION_FROM_FREEZING = 'PROTECTION_FROM_FREEZING';
    const _RAIL_MODE = 'RAIL_MODE';
    const _RECONSIGNMENT_CHARGES = 'RECONSIGNMENT_CHARGES';
    const _REROUTE_CROSS_COUNTRY_DEFERRED = 'REROUTE_CROSS_COUNTRY_DEFERRED';
    const _REROUTE_CROSS_COUNTRY_EXPEDITED = 'REROUTE_CROSS_COUNTRY_EXPEDITED';
    const _REROUTE_LOCAL = 'REROUTE_LOCAL';
    const _RESIDENTIAL_DELIVERY = 'RESIDENTIAL_DELIVERY';
    const _RESIDENTIAL_PICKUP = 'RESIDENTIAL_PICKUP';
    const _RETURNS_CLEARANCE = 'RETURNS_CLEARANCE';
    const _RETURNS_CLEARANCE_SPECIAL_ROUTING_REQUIRED = 'RETURNS_CLEARANCE_SPECIAL_ROUTING_REQUIRED';
    const _RETURN_MANAGER = 'RETURN_MANAGER';
    const _SATURDAY_DELIVERY = 'SATURDAY_DELIVERY';
    const _SHIPMENT_PLACED_IN_COLD_STORAGE = 'SHIPMENT_PLACED_IN_COLD_STORAGE';
    const _SINGLE_SHIPMENT = 'SINGLE_SHIPMENT';
    const _SMALL_QUANTITY_EXCEPTION = 'SMALL_QUANTITY_EXCEPTION';
    const _SORT_AND_SEGREGATE = 'SORT_AND_SEGREGATE';
    const _SPECIAL_DELIVERY = 'SPECIAL_DELIVERY';
    const _SPECIAL_EQUIPMENT = 'SPECIAL_EQUIPMENT';
    const _STANDARD_GROUND_SERVICE = 'STANDARD_GROUND_SERVICE';
    const _STORAGE = 'STORAGE';
    const _SUNDAY_DELIVERY = 'SUNDAY_DELIVERY';
    const _THIRD_PARTY_BILLING = 'THIRD_PARTY_BILLING';
    const _THIRD_PARTY_CONSIGNEE = 'THIRD_PARTY_CONSIGNEE';
    const _TOP_LOAD = 'TOP_LOAD';
    const _WEEKEND_DELIVERY = 'WEEKEND_DELIVERY';
    const _WEEKEND_PICKUP = 'WEEKEND_PICKUP';
}
