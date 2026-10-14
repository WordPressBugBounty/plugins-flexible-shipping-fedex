<?php

declare (strict_types=1);
namespace FedExVendor\CageA80\FedEx\Support;

/**
 * Postal code requirements according to the FedEx API Reference Guide.
 *
 * @see https://developer.fedex.com/api/en-us/guides/api-reference.html
 * @see https://developer.fedex.com/wirc/json/api_groups/API_Reference_Guide.json
 */
final class PostalCodeRequirements
{
    /**
     * FedEx postal-aware countries, verified on 2026-10-12.
     * Puerto Rico uses its own ISO code although the reference table lists US.
     */
    private const POSTAL_AWARE_COUNTRIES = ['AT', 'AU', 'BE', 'BG', 'BR', 'CA', 'CH', 'CL', 'CN', 'CO', 'CY', 'CZ', 'DE', 'DK', 'EC', 'EE', 'ES', 'FI', 'FR', 'GB', 'GR', 'HU', 'ID', 'IE', 'IN', 'IT', 'JP', 'KR', 'LT', 'LU', 'LV', 'MX', 'MY', 'NL', 'NO', 'PH', 'PL', 'PR', 'PT', 'RO', 'RU', 'SA', 'SE', 'SG', 'SI', 'SK', 'TH', 'TR', 'UA', 'US', 'ZA'];
    public static function isRequired(string $countryCode): bool
    {
        return in_array(strtoupper(trim($countryCode)), self::POSTAL_AWARE_COUNTRIES, \true);
    }
}
