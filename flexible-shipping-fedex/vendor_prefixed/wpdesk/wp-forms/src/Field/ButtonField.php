<?php

namespace FedExVendor\WPDesk\Forms\Field;

class ButtonField extends \FedExVendor\WPDesk\Forms\Field\NoValueField
{
    public function get_template_name() : string
    {
        return 'button';
    }
    public function get_type() : string
    {
        return 'button';
    }
}