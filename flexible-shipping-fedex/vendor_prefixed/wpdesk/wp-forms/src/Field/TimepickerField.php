<?php

namespace FedExVendor\WPDesk\Forms\Field;

use FedExVendor\WPDesk\Forms\Serializer;
use FedExVendor\WPDesk\Forms\Serializer\JsonSerializer;
class TimepickerField extends \FedExVendor\WPDesk\Forms\Field\BasicField
{
    public function get_type() : string
    {
        return 'time';
    }
    public function has_serializer() : bool
    {
        return \true;
    }
    public function get_serializer() : \FedExVendor\WPDesk\Forms\Serializer
    {
        return new \FedExVendor\WPDesk\Forms\Serializer\JsonSerializer();
    }
    public function get_template_name() : string
    {
        return 'timepicker';
    }
}
