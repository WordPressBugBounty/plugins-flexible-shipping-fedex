<?php

namespace FedExVendor\WPDesk\Forms\Sanitizer;

use FedExVendor\WPDesk\Forms\Sanitizer;
class NoSanitize implements Sanitizer
{
    public function sanitize($value)
    {
        return $value;
    }
}
