<?php

/**
 * Settings definitions.
 *
 * @package WPDesk\WooCommerceShipping\Fedex
 */
namespace FedExVendor\WPDesk\WooCommerceShipping\Fedex;

use FedExVendor\WPDesk\AbstractShipping\Settings\SettingsValues;
use FedExVendor\WPDesk\FedexShippingService\FedexSettingsDefinition;
use FedExVendor\WPDesk\UpsShippingService\UpsSettingsDefinition;
use FedExVendor\WPDesk\WooCommerceShipping\ApiStatus\ApiStatusSettingsDefinitionDecorator;
use FedExVendor\WPDesk\WooCommerceShipping\CustomFields\FieldApiStatusAjax;
use FedExVendor\WPDesk\WooCommerceShipping\ShippingMethod\RateMethod\Fallback\FallbackRateMethod;
/**
 * Can handle global and instance settings for WooCommerce shipping method.
 */
class FedexSettingsDefinitionWooCommerce extends FedexSettingsDefinition
{
    protected $global_method_fields = [FedexSettingsDefinition::FEDEX_HEADER, FedexSettingsDefinition::CREDENTIALS_HEADER, FedexSettingsDefinition::API_TYPE, FedexSettingsDefinition::FIELD_REST_API_KEY, FedexSettingsDefinition::FIELD_REST_SECRET_KEY, FedexSettingsDefinition::FIELD_ACCOUNT_NUMBER, FedexSettingsDefinition::FIELD_METER_NUMBER, FedexSettingsDefinition::FIELD_API_KEY, FedexSettingsDefinition::FIELD_API_PASSWORD, FedexSettingsDefinition::TESTING, FedexSettingsDefinition::SHIPPING_METHOD_HEADER, FedexSettingsDefinition::ENABLE_SHIPPING_METHOD, FedexSettingsDefinition::METHOD_TITLE, FedexSettingsDefinition::ADVANCED_OPTIONS_HEADER, FedexSettingsDefinition::DEBUG_MODE, FedexSettingsDefinition::FIELD_UNITS, ApiStatusSettingsDefinitionDecorator::API_STATUS];
    private $instance_and_method_fields = [FedexSettingsDefinition::METHOD_TITLE];
    /**
     * Form fields.
     *
     * @var array
     */
    private $form_fields;
    /**
     * UpsSettingsDefinitionWooCommerce constructor.
     *
     * @param array $form_fields Form fields.
     */
    public function __construct(array $form_fields, bool $default_api_type_soap = \true)
    {
        $this->form_fields = $form_fields;
        if ($default_api_type_soap) {
            $this->form_fields[FedexSettingsDefinition::API_TYPE]['default'] = FedexSettingsDefinition::API_TYPE_SOAP;
        }
    }
    /**
     * Get form fields.
     *
     * @return array
     */
    public function get_form_fields()
    {
        return $this->form_fields;
    }
    /**
     * Get instance form fields.
     *
     * @return array
     */
    public function get_instance_form_fields()
    {
        return $this->filter_instance_fields($this->form_fields, \true);
    }
    /**
     * Get global method fields.
     *
     * @return array
     */
    protected function get_global_method_fields()
    {
        return $this->global_method_fields;
    }
    /**
     * Filter instance form fields.
     *
     * @param array $all_fields .
     * @param bool  $instance_fields .
     *
     * @return array
     */
    private function filter_instance_fields(array $all_fields, $instance_fields)
    {
        $fields = array();
        foreach ($all_fields as $key => $field) {
            $is_instance_field = !in_array($key, $this->get_global_method_fields(), \true) || in_array($key, $this->instance_and_method_fields, \true);
            if ($instance_fields === $is_instance_field) {
                $fields[$key] = $field;
            }
        }
        return $fields;
    }
}
