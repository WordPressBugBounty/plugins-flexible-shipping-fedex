<?php

namespace FedExVendor\WPDesk\Forms\Sanitizer;

use FedExVendor\WPDesk\Forms\Sanitizer;
class NoSanitize implements \FedExVendor\WPDesk\Forms\Sanitizer
{
    public function sanitize($value)
    {
        return $value;
    }
}
