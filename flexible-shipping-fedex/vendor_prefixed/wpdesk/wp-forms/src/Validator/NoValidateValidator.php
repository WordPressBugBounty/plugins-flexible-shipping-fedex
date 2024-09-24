<?php

namespace FedExVendor\WPDesk\Forms\Validator;

use FedExVendor\WPDesk\Forms\Validator;
class NoValidateValidator implements \FedExVendor\WPDesk\Forms\Validator
{
    public function is_valid($value) : bool
    {
        return \true;
    }
    public function get_messages() : array
    {
        return [];
    }
}