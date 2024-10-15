<?php

namespace FedExVendor\WPDesk\View\Resolver;

use FedExVendor\WPDesk\View\Renderer\Renderer;
use FedExVendor\WPDesk\View\Resolver\Exception\CanNotResolve;
/**
 * This resolver never finds the file
 *
 * @package WPDesk\View\Resolver
 */
class NullResolver implements Resolver
{
    public function resolve($name, Renderer $renderer = null)
    {
        throw new CanNotResolve('Null Cannot resolve');
    }
}
