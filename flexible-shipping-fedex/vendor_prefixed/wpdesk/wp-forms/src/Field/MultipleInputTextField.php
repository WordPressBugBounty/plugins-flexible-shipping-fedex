<?php

namespace FedExVendor\WPDesk\Forms\Field;

class MultipleInputTextField extends \FedExVendor\WPDesk\Forms\Field\InputTextField
{
    public function get_template_name() : string
    {
        return 'input-text-multiple';
    }
}
