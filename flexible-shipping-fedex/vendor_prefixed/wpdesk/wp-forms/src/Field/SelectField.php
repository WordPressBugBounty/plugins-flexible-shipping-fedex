<?php

namespace FedExVendor\WPDesk\Forms\Field;

use FedExVendor\WPDesk\Forms\Field;
class SelectField extends \FedExVendor\WPDesk\Forms\Field\BasicField
{
    public function get_type() : string
    {
        return 'select';
    }
    public function get_template_name() : string
    {
        return 'select';
    }
    /** @param string[] $options */
    public function set_options(array $options) : \FedExVendor\WPDesk\Forms\Field
    {
        $this->meta['possible_values'] = $options;
        return $this;
    }
    public function set_multiple() : \FedExVendor\WPDesk\Forms\Field
    {
        $this->attributes['multiple'] = 'multiple';
        return $this;
    }
}
