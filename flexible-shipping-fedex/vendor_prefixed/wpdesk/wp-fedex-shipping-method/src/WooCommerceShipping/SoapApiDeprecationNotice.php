<?php

namespace FedExVendor\WPDesk\WooCommerceShipping\Fedex;

use FedExVendor\WPDesk\Notice\Notice;
use FedExVendor\WPDesk\PluginBuilder\Plugin\Hookable;
class SoapApiDeprecationNotice implements Hookable
{
    /**
     * @var bool
     */
    private $soap_api_in_use;
    public function __construct(bool $soap_api_in_use)
    {
        $this->soap_api_in_use = $soap_api_in_use;
    }
    public function hooks()
    {
        add_action('admin_notices', [$this, 'display_notice_when_soap_api_in_use']);
    }
    public function display_notice_when_soap_api_in_use()
    {
        if (!$this->soap_api_in_use) {
            return;
        }
        $settings_url = admin_url('admin.php?page=wc-settings&tab=shipping&section=' . FedexShippingMethod::UNIQUE_ID);
        ob_start();
        include __DIR__ . '/views/soap-api-deprecation-notice.php';
        $content = (string) ob_get_clean();
        new Notice($content, 'warning');
    }
}
