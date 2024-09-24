<?php

namespace FedExVendor;

return [
    /*
    |--------------------------------------------------------------------------
    | Credentials
    |--------------------------------------------------------------------------
    |
    | Common FedEx web services credentials
    |
    */
    'environment' => \FedExVendor\env('FEDEX_ENVIRONMENT', \FedExVendor\CageA80\FedEx\Support\EnvironmentType::SANDBOX),
    'mockEndpoint' => \FedExVendor\env('FEDEX_MOCK_ENDPOINT', '/api/v1/fedex-mock'),
    'accountNumber' => \FedExVendor\env('FEDEX_ACCOUNT_NUMBER' . (\FedExVendor\env('FEDEX_ENVIRONMENT', \FedExVendor\CageA80\FedEx\Support\EnvironmentType::SANDBOX) == \FedExVendor\CageA80\FedEx\Support\EnvironmentType::SANDBOX ? '_SANDBOX' : '')),
    'key' => \FedExVendor\env('FEDEX_KEY' . (\FedExVendor\env('FEDEX_ENVIRONMENT', \FedExVendor\CageA80\FedEx\Support\EnvironmentType::SANDBOX) == \FedExVendor\CageA80\FedEx\Support\EnvironmentType::SANDBOX ? '_SANDBOX' : '')),
    'secret' => \FedExVendor\env('FEDEX_SECRET' . (\FedExVendor\env('FEDEX_ENVIRONMENT', \FedExVendor\CageA80\FedEx\Support\EnvironmentType::SANDBOX) == \FedExVendor\CageA80\FedEx\Support\EnvironmentType::SANDBOX ? '_SANDBOX' : '')),
    /*
    |--------------------------------------------------------------------------
    | Carrier Codes
    |--------------------------------------------------------------------------
    |
    | Candidate carriers for rate-shopping use case. This field is only
    | considered if requestedShipment/serviceType is omitted.
    |
    */
    'carrierCodes' => [\FedExVendor\CageA80\FedEx\Support\CarrierCodeType::FEDEX_GROUND, \FedExVendor\CageA80\FedEx\Support\CarrierCodeType::FEDEX_EXPRESS],
    /*
    |--------------------------------------------------------------------------
    | Rate types
    |--------------------------------------------------------------------------
    | Indicate the type of rates to be returned.
    | Use the RateRequestTypes element to request specific rates whether LIST
    | or account specific. If you choose LIST as the element value, you receive
    | both account specific and list rates, in addition to rate quotes
    | generated via FedEx electronic solutions.
    |
    | Valid values: LIST | INCENTIVE | ACCOUNT | PREFERRED
    |
    | Request field: rateRequestType
    |
    */
    'rateRequestType' => [\FedExVendor\CageA80\FedEx\Support\RateRequestType::LIST],
    /*
    |--------------------------------------------------------------------------
    | Auth provider
    |--------------------------------------------------------------------------
    | Specify auth token provider.
    |
    | Valid values: \CageA80\FedEx\AuthProvider | \CageA80\FedEx\AuthCacheProvider
    |
    */
    'authProvider' => \FedExVendor\CageA80\FedEx\AuthCacheProvider::class,
    /*
    |--------------------------------------------------------------------------
    | Request duties and taxes
    |--------------------------------------------------------------------------
    |
    | Request estimated duties and taxes related information
    |
    | Valid values: NONE | ALL
    |
    | Request field: edtRequestType
    */
    'edtRequestType' => \FedExVendor\CageA80\FedEx\Support\EdtRequestType::NONE,
    /*
    |--------------------------------------------------------------------------
    | Weight Units
    |--------------------------------------------------------------------------
    |
    | Valid units: LB | KG
    |
    */
    'weightUnits' => \FedExVendor\CageA80\FedEx\Support\WeightUnit::LB,
    /*
    |--------------------------------------------------------------------------
    | Max Package Weight
    |--------------------------------------------------------------------------
    |
    | Maximum wait of a single package (LB).
    |
    */
    'maxPackageWeight' => 25,
    /*
    |--------------------------------------------------------------------------
    | Packaging Types
    |--------------------------------------------------------------------------
    | This is the Packaging type associated with this rate. For Ground/SmartPost,
    | it will always be YOUR_PACKAGING. For domestic Express, the packaging may
    | have been bumped so it may not match the value specified on the request.
    | For International Express the packaging may be bumped and not mapped.
    | If YOUR_PACKAGING type is used then package dimensions should be defined.
    |
    | Request field: packagingType
    |
    */
    'packaging' => \FedExVendor\CageA80\FedEx\Support\PackagingType::YOUR_PACKAGING,
    /*
    |--------------------------------------------------------------------------
    | Custom Package Dimensions
    |--------------------------------------------------------------------------
    |
    | These settings will be used when 'YOUR_PACKAGING' package type is used
    |
    */
    'customPackage' => ['dimensionUnits' => \FedExVendor\CageA80\FedEx\Support\DimensionUnit::INCHES, 'length' => 14, 'width' => 14, 'height' => 7],
    /*
    |--------------------------------------------------------------------------
    | Drop-off Type
    |--------------------------------------------------------------------------
    |
    | Indicate the pickup type method by which the shipment to be tendered to FedEx.
    |
    | Request field: pickupType
    |
    */
    'pickupType' => \FedExVendor\CageA80\FedEx\Support\PickupType::DROPOFF_AT_FEDEX_LOCATION,
    /*
    |--------------------------------------------------------------------------
    | Payment Method
    |--------------------------------------------------------------------------
    |
    | Type of payment for shipment.
    | Indicate the payment Type. Applicable for Express and Ground rates.
    |
    | Request field: 'dutiesPayment.paymentType'
    |
    */
    'paymentType' => \FedExVendor\CageA80\FedEx\Support\PaymentMethod::SENDER,
    /*
    |--------------------------------------------------------------------------
    | Payor details
    |--------------------------------------------------------------------------
    |
    | Payor details are optional if 'paymentMethod' == SENDER.
    |
    | Request field: 'dutiesPayment.payor.responsibleParty'
    |
    */
    'payor' => ['accountNumber' => \FedExVendor\env('FEDEX_ACCOUNT_NUMBER' . (\FedExVendor\env('FEDEX_ENVIRONMENT', \FedExVendor\CageA80\FedEx\Support\EnvironmentType::SANDBOX) == \FedExVendor\CageA80\FedEx\Support\EnvironmentType::SANDBOX ? '_SANDBOX' : '')), 'address' => ['city' => \FedExVendor\env('FEDEX_PAYOR_CITY'), 'stateOrProvinceCode' => \FedExVendor\env('FEDEX_PAYOR_STATE'), 'postalCode' => \FedExVendor\env('FEDEX_PAYOR_ZIP'), 'countryCode' => \FedExVendor\env('FEDEX_PAYOR_COUNTRY', 'US')]],
    /*
    |--------------------------------------------------------------------------
    | Transit times
    |--------------------------------------------------------------------------
    |
    | Specify return transit times
    |
    | Request field: 'rateRequestControlParameters.returnTransitTimes'
    |
    */
    'returnTransitTimes' => \FedExVendor\env('FEDEX_TRANSIT_TIMES', \false),
    /*
    |--------------------------------------------------------------------------
    | Timeout
    |--------------------------------------------------------------------------
    |
    | Specify HTTP request timeout in seconds
    |
    */
    'timeout' => \FedExVendor\env('FEDEX_HTTP_TIMEOUT', 20),
    /*
    |--------------------------------------------------------------------------
    | Request attempts
    |--------------------------------------------------------------------------
    |
    | Specify the number of HTTP request attempts
    |
    */
    'attempts' => \FedExVendor\env('FEDEX_HTTP_ATTEMPTS', 3),
    /*
    |--------------------------------------------------------------------------
    | Verify SSL
    |--------------------------------------------------------------------------
    |
    | Specify whether GuzzleHttp should verify SSL cert
    |
    */
    'verifySSL' => \FedExVendor\env('FEDEX_VERIFY_SSL', \true),
    /*
    |--------------------------------------------------------------------------
    | Rates RAW
    |--------------------------------------------------------------------------
    |
    | Include rates RAW data in the output feed
    |
    */
    'ratesRaw' => \false,
    /*
    |--------------------------------------------------------------------------
    | Sample data
    |--------------------------------------------------------------------------
    |
    | Use sample data instead of sending real request to FedEx
    |
    */
    'sampleData' => \FedExVendor\env('FEDEX_SAMPLE_DATA', \false),
    /*
    |--------------------------------------------------------------------------
    | Logging
    |--------------------------------------------------------------------------
    |
    | Enabled logging request and response data
    |
    */
    'log' => \FedExVendor\env('FEDEX_LOG', \false),
    /*
    |--------------------------------------------------------------------------
    | Logging channel
    |--------------------------------------------------------------------------
    |
    | Specify logging channel
    |
    */
    'logChannel' => \FedExVendor\env('FEDEX_LOG_CHANNEL'),
];
