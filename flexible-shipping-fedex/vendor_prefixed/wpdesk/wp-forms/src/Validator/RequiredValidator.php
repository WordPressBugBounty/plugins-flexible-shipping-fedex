<?php

namespace FedExVendor\WPDesk\Forms\Validator;

use FedExVendor\WPDesk\Forms\Validator;
class RequiredValidator implements Validator
{
    public function is_valid($value): bool
    {
        return $value !== null;
    }
    public function get_messages(): array
    {
        return [];
    }
}
