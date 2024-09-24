<?php

namespace FedExVendor\WPDesk\Forms\Sanitizer;

use FedExVendor\WPDesk\Forms\Sanitizer;
class EmailSanitizer implements \FedExVendor\WPDesk\Forms\Sanitizer
{
    public function sanitize($value) : string
    {
        return \sanitize_email($value);
    }
}
