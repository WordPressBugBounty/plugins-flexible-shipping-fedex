<?php

namespace FedExVendor\WPDesk\Forms\Field;

use FedExVendor\WPDesk\Forms\Sanitizer;
use FedExVendor\WPDesk\Forms\Sanitizer\TextFieldSanitizer;
class HiddenField extends \FedExVendor\WPDesk\Forms\Field\BasicField
{
    public function get_type() : string
    {
        return 'hidden';
    }
    public function get_sanitizer() : \FedExVendor\WPDesk\Forms\Sanitizer
    {
        return new \FedExVendor\WPDesk\Forms\Sanitizer\TextFieldSanitizer();
    }
    public function get_template_name() : string
    {
        return 'input-hidden';
    }
}
