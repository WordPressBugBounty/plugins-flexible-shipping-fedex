<?php

/**
 * Fedex Shipping Method.
 *
 * @package WPDesk\WooCommerceShipping\Fedex
 */
namespace FedExVendor\WPDesk\WooCommerceShipping\Fedex;

use FedExVendor\WPDesk\FedexShippingService\FedexSettingsDefinition;
use FedExVendor\WPDesk\WooCommerceShipping\CustomFields\ApiStatus\FieldApiStatusAjax;
use FedExVendor\WPDesk\WooCommerceShipping\ShippingMethod;
/**
 * Fedex Shipping Method.
 */
class FedexShippingMethod extends ShippingMethod implements ShippingMethod\HasRateCache
{
    const UNIQUE_ID = 'flexible_shipping_fedex';
    /**
     * .
     *
     * @var FieldApiStatusAjax
     */
    protected static $api_status_ajax_handler;
    /**
     * .
     *
     * @param int $instance_id Instance ID.
     */
    public function __construct($instance_id = 0)
    {
        parent::__construct($instance_id);
        $this->title = $this->get_option('title', $this->title);
    }
    public function process_admin_options()
    {
        parent::process_admin_options();
        if (!$this->instance_id) {
            (new RestApiAuthProvider())->flush();
        }
    }
    /**
     * Init form fields.
     */
    public function build_form_fields()
    {
        $default_api_type_soap = empty($this->get_option(FedexSettingsDefinition::API_TYPE, '')) && !empty($this->get_option(FedexSettingsDefinition::FIELD_API_KEY, ''));
        $settings_definition = new FedexSettingsDefinitionWooCommerce($this->form_fields, $default_api_type_soap);
        $this->form_fields = $settings_definition->get_form_fields();
        $this->instance_form_fields = $settings_definition->get_instance_form_fields();
    }
    /**
     * @return bool
     */
    protected function should_calculate_shipping()
    {
        return \true;
    }
    public function admin_options()
    {
        parent::admin_options();
        if (0 === $this->instance_id) {
            $this->output_settings_script();
        }
    }
    private function output_settings_script()
    {
        include __DIR__ . '/views/settings-scrips.php';
    }
}
