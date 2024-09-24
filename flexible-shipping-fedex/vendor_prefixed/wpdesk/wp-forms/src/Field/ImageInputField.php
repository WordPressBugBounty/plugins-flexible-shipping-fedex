<?php

namespace FedExVendor\WPDesk\Forms\Field;

class ImageInputField extends \FedExVendor\WPDesk\Forms\Field\BasicField
{
    public function get_template_name() : string
    {
        return 'input-image';
    }
}
