<?php

namespace FedExVendor\WPDesk\Forms\Field;

use FedExVendor\WPDesk\Forms\Sanitizer;
use FedExVendor\WPDesk\Forms\Sanitizer\TextFieldSanitizer;
class InputTextField extends BasicField
{
    public function get_sanitizer(): Sanitizer
    {
        return new TextFieldSanitizer();
    }
    public function get_template_name(): string
    {
        return 'input-text';
    }
}
