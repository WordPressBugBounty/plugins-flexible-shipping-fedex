<?php

namespace FedExVendor\WPDesk\View\Resolver;

use FedExVendor\WPDesk\View\Renderer\Renderer;
use FedExVendor\WPDesk\View\Resolver\Exception\CanNotResolve;
/**
 * Class should resolve name by standard wp theme resolve
 *
 * @package WPDesk\View\Resolver
 */
class WPThemeResolver implements Resolver
{
    /** @var string */
    private $template_base_path;
    /**
     * Base path for templates ie. subdir
     *
     * @param $template_base_path
     */
    public function __construct($template_base_path)
    {
        $this->template_base_path = $template_base_path;
    }
    /**
     * Resolve name to full path
     *
     * @param string $name
     * @param Renderer|null $renderer
     *
     * @return string
     */
    public function resolve($name, Renderer $renderer = null)
    {
        $templateFile = locate_template([trailingslashit($this->template_base_path) . $name]);
        if (!$templateFile) {
            throw new CanNotResolve("Cannot resolve {$name}");
        }
        return $templateFile;
    }
}
