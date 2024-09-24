<?php

namespace FedExVendor\WPDesk\ShowDecision\WooCommerce;

use FedExVendor\WPDesk\ShowDecision\GetStrategy;
class ShippingMethodStrategy extends \FedExVendor\WPDesk\ShowDecision\GetStrategy
{
    public function __construct(string $method_id)
    {
        parent::__construct([['page' => 'wc-settings', 'tab' => 'shipping', 'section' => $method_id]]);
    }
}
