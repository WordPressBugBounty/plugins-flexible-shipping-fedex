<?php

namespace FedExVendor\WPDesk\Forms\Field;

class WPEditorField extends \FedExVendor\WPDesk\Forms\Field\BasicField
{
    public function get_template_name() : string
    {
        return 'wp-editor';
    }
}
