<?php

namespace FedExVendor\WPDesk\Forms\Resolver;

use FedExVendor\WPDesk\View\Renderer\Renderer;
use FedExVendor\WPDesk\View\Resolver\DirResolver;
use FedExVendor\WPDesk\View\Resolver\Resolver;
/**
 * Use with View to resolver form fields to default templates.
 *
 * @package WPDesk\Forms\Resolver
 */
class DefaultFormFieldResolver implements \FedExVendor\WPDesk\View\Resolver\Resolver
{
    /** @var Resolver */
    private $dir_resolver;
    public function __construct()
    {
        $this->dir_resolver = new \FedExVendor\WPDesk\View\Resolver\DirResolver(__DIR__ . '/../../templates');
    }
    public function resolve($name, \FedExVendor\WPDesk\View\Renderer\Renderer $renderer = null) : string
    {
        return $this->dir_resolver->resolve($name, $renderer);
    }
}
