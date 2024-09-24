<?php

namespace FedExVendor\WPDesk\FedexShippingService\FedexApi\RestApi;

use FedExVendor\CageA80\FedEx\Support\EnvironmentType;
use FedExVendor\WPDesk\AbstractShipping\Settings\SettingsValues;
use FedExVendor\WPDesk\FedexShippingService\FedexSettingsDefinition;
class RestApiConfig
{
    /**
     * @var SettingsValues
     */
    private $settings;
    /**
     * @var string
     */
    private $auth_provider_class;
    public function __construct(\FedExVendor\WPDesk\AbstractShipping\Settings\SettingsValues $settings, string $auth_provider_class = null)
    {
        $this->settings = $settings;
        $this->auth_provider_class = $auth_provider_class;
    }
    public function prepare_config()
    {
        $config = ['accountNumber' => $this->settings->get_value(\FedExVendor\WPDesk\FedexShippingService\FedexSettingsDefinition::FIELD_ACCOUNT_NUMBER), 'key' => $this->settings->get_value(\FedExVendor\WPDesk\FedexShippingService\FedexSettingsDefinition::FIELD_REST_API_KEY), 'secret' => $this->settings->get_value(\FedExVendor\WPDesk\FedexShippingService\FedexSettingsDefinition::FIELD_REST_SECRET_KEY), 'environment' => \FedExVendor\CageA80\FedEx\Support\EnvironmentType::PRODUCTION];
        if ($this->auth_provider_class) {
            $config['authProvider'] = $this->auth_provider_class;
        }
        return $config;
    }
}
