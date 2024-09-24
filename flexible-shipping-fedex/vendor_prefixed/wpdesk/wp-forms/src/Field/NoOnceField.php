<?php

namespace FedExVendor\WPDesk\Forms\Field;

use FedExVendor\WPDesk\Forms\Validator;
use FedExVendor\WPDesk\Forms\Validator\NonceValidator;
class NoOnceField extends \FedExVendor\WPDesk\Forms\Field\BasicField
{
    public function __construct(string $action_name)
    {
        $this->meta['action'] = $action_name;
    }
    public function get_validator() : \FedExVendor\WPDesk\Forms\Validator
    {
        return new \FedExVendor\WPDesk\Forms\Validator\NonceValidator($this->get_meta_value('action'));
    }
    public function get_template_name() : string
    {
        return 'noonce';
    }
}
