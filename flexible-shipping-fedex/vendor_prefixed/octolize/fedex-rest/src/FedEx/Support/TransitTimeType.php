<?php

namespace FedExVendor\CageA80\FedEx\Support;

class TransitTimeType
{
    const EIGHTEEN_DAYS = 'EIGHTEEN_DAYS';
    const EIGHT_DAYS = 'EIGHT_DAYS';
    const ELEVEN_DAYS = 'ELEVEN_DAYS';
    const FIFTEEN_DAYS = 'FIFTEEN_DAYS';
    const FIVE_DAYS = 'FIVE_DAYS';
    const FOURTEEN_DAYS = 'FOURTEEN_DAYS';
    const FOUR_DAYS = 'FOUR_DAYS';
    const NINETEEN_DAYS = 'NINETEEN_DAYS';
    const NINE_DAYS = 'NINE_DAYS';
    const ONE_DAY = 'ONE_DAY';
    const SEVENTEEN_DAYS = 'SEVENTEEN_DAYS';
    const SEVEN_DAYS = 'SEVEN_DAYS';
    const SIXTEEN_DAYS = 'SIXTEEN_DAYS';
    const SIX_DAYS = 'SIX_DAYS';
    const TEN_DAYS = 'TEN_DAYS';
    const THIRTEEN_DAYS = 'THIRTEEN_DAYS';
    const THREE_DAYS = 'THREE_DAYS';
    const TWELVE_DAYS = 'TWELVE_DAYS';
    const TWENTY_DAYS = 'TWENTY_DAYS';
    const TWO_DAYS = 'TWO_DAYS';
    const UNKNOWN = 'UNKNOWN';
    public static function toNumber($transitTimeType)
    {
        $list = [\FedExVendor\CageA80\FedEx\Support\TransitTimeType::EIGHTEEN_DAYS => 18, \FedExVendor\CageA80\FedEx\Support\TransitTimeType::EIGHT_DAYS => 8, \FedExVendor\CageA80\FedEx\Support\TransitTimeType::ELEVEN_DAYS => 11, \FedExVendor\CageA80\FedEx\Support\TransitTimeType::FIFTEEN_DAYS => 15, \FedExVendor\CageA80\FedEx\Support\TransitTimeType::FIVE_DAYS => 5, \FedExVendor\CageA80\FedEx\Support\TransitTimeType::FOURTEEN_DAYS => 14, \FedExVendor\CageA80\FedEx\Support\TransitTimeType::FOUR_DAYS => 4, \FedExVendor\CageA80\FedEx\Support\TransitTimeType::NINETEEN_DAYS => 19, \FedExVendor\CageA80\FedEx\Support\TransitTimeType::NINE_DAYS => 9, \FedExVendor\CageA80\FedEx\Support\TransitTimeType::ONE_DAY => 1, \FedExVendor\CageA80\FedEx\Support\TransitTimeType::SEVENTEEN_DAYS => 17, \FedExVendor\CageA80\FedEx\Support\TransitTimeType::SEVEN_DAYS => 7, \FedExVendor\CageA80\FedEx\Support\TransitTimeType::SIXTEEN_DAYS => 16, \FedExVendor\CageA80\FedEx\Support\TransitTimeType::SIX_DAYS => 6, \FedExVendor\CageA80\FedEx\Support\TransitTimeType::TEN_DAYS => 10, \FedExVendor\CageA80\FedEx\Support\TransitTimeType::THIRTEEN_DAYS => 13, \FedExVendor\CageA80\FedEx\Support\TransitTimeType::THREE_DAYS => 3, \FedExVendor\CageA80\FedEx\Support\TransitTimeType::TWELVE_DAYS => 12, \FedExVendor\CageA80\FedEx\Support\TransitTimeType::TWENTY_DAYS => 20, \FedExVendor\CageA80\FedEx\Support\TransitTimeType::TWO_DAYS => 2, \FedExVendor\CageA80\FedEx\Support\TransitTimeType::UNKNOWN => null];
        return \is_null($transitTimeType) ? null : $list[$transitTimeType] ?? null;
    }
}
