<?php

/**
 * Class BlackoutLeadDaysSettingsDefinitionDecoratorFactory
 *
 * @package WPDesk\AbstractShipping\Settings\SettingsDecorators
 */
namespace FedExVendor\WPDesk\AbstractShipping\Settings\SettingsDecorators;

/**
 * Can create Blackout Lead Days settings decorator.
 */
class BlackoutLeadDaysSettingsDefinitionDecoratorFactory extends AbstractDecoratorFactory
{
    const OPTION_ID = 'blackout_lead_days';
    /**
     * @return string
     */
    public function get_field_id()
    {
        return self::OPTION_ID;
    }
    /**
     * @return array
     */
    protected function get_field_settings()
    {
        return array('title' => __('Blackout Lead Days', 'flexible-shipping-fedex'), 'type' => 'multiselect', 'description' => __('Blackout Lead Days are used to define days of the week when shop is not processing orders.', 'flexible-shipping-fedex'), 'options' => array('1' => __('Monday', 'flexible-shipping-fedex'), '2' => __('Tuesday', 'flexible-shipping-fedex'), '3' => __('Wednesday', 'flexible-shipping-fedex'), '4' => __('Thursday', 'flexible-shipping-fedex'), '5' => __('Friday', 'flexible-shipping-fedex'), '6' => __('Saturday', 'flexible-shipping-fedex'), '7' => __('Sunday', 'flexible-shipping-fedex')), 'custom_attributes' => array('size' => 7), 'class' => 'wc-enhanced-select', 'desc_tip' => \true, 'default' => '');
    }
}
