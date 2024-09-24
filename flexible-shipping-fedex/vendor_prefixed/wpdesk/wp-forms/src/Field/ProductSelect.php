<?php

namespace FedExVendor\WPDesk\Forms\Field;

use FedExVendor\WPDesk\Forms\Serializer\ProductSelectSerializer;
use FedExVendor\WPDesk\Forms\Serializer;
class ProductSelect extends \FedExVendor\WPDesk\Forms\Field\SelectField
{
    public function __construct()
    {
        $this->set_multiple();
    }
    public function has_serializer() : bool
    {
        return \true;
    }
    public function get_serializer() : \FedExVendor\WPDesk\Forms\Serializer
    {
        return new \FedExVendor\WPDesk\Forms\Serializer\ProductSelectSerializer();
    }
    public function get_template_name() : string
    {
        return 'product-select';
    }
}
