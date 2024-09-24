<?php

namespace FedExVendor\WPDesk\Tracker\Deactivation;

/**
 * Can generate deactivation thickbox content.
 */
class Thickbox
{
    use DeactivationContent;
    /**
     * Constructor.
     *
     * @param PluginData $plugin_data .
     * @param string|null $view_file .
     */
    public function __construct(\FedExVendor\WPDesk\Tracker\Deactivation\PluginData $plugin_data, \FedExVendor\WPDesk\Tracker\Deactivation\ReasonsFactory $reasons_factory, $view_file = null)
    {
        $this->plugin_data = $plugin_data;
        $this->reasons_factory = $reasons_factory;
        if (!empty($view_file)) {
            $this->view_file = $view_file;
        } else {
            $this->view_file = __DIR__ . '/views/thickbox.php';
        }
    }
}
