<?php

namespace FedExVendor\Octolize\Brand\UpsellingBox;

use FedExVendor\WPDesk\ShowDecision\AndStrategy;
class ShippingMethodAndConstantDisplayStrategy extends \FedExVendor\WPDesk\ShowDecision\AndStrategy
{
    public function __construct(string $method_id, string $constant)
    {
        parent::__construct(new \FedExVendor\Octolize\Brand\UpsellingBox\ConstantShouldShowStrategy($constant));
        $this->addCondition(new \FedExVendor\Octolize\Brand\UpsellingBox\ShippingMethodShouldShowStrategy($method_id));
    }
}
