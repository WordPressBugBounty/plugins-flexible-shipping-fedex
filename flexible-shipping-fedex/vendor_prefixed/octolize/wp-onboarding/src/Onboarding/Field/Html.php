<?php

namespace FedExVendor\Octolize\Onboarding\Field;

use FedExVendor\WPDesk\Forms\Field\BasicField;
/**
 * Html field.
 */
class Html extends BasicField
{
    protected $meta = ['priority' => self::DEFAULT_PRIORITY, 'default_value' => '', 'label' => '', 'description' => '', 'description_tip' => '', 'data' => [], 'type' => 'html'];
    public function get_template_name(): string
    {
        return 'html';
    }
}
