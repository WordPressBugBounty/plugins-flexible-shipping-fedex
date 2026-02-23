<?php

namespace FedExVendor;

/**
 * @var string $settings_url
 */
?>
<p><strong><?php 
echo \esc_html(\__('FedEx SOAP Web Services are being retired — action required', 'flexible-shipping-fedex'));
?></strong></p>
<p><?php 
echo \esc_html(\__('FedEx will retire its legacy SOAP Web Services in June 2026. Our plugin fully supports the new FedEx REST API.', 'flexible-shipping-fedex'));
?></p>
<p><?php 
echo \esc_html(\__('You are currently using FedEx SOAP Web Services credentials. To avoid any disruption of service, you need to update your configuration.', 'flexible-shipping-fedex'));
?></p>

<p>
	<?php 
\esc_html_e('What you need to do:', 'flexible-shipping-fedex');
?><br/>
	<?php 
echo \wp_kses_post(\sprintf(\__(' - Go to %1$splugin settings%2$s,', 'flexible-shipping-fedex'), '<a href="' . \esc_url($settings_url) . '">', '</a>'));
?><br/>
	<?php 
echo \wp_kses_post(\sprintf(\__(' - Switch API Type to use %1$sFedEx REST API%2$s,', 'flexible-shipping-fedex'), '<strong>', '</strong>'));
?><br/>
	<?php 
\esc_html_e(' - Generate your REST API credentials by following this guide:', 'flexible-shipping-fedex');
?><br/>
	<?php 
echo \wp_kses_post(\sprintf(\__(' - %1$shttps://octolize.com/docs/article/fedex-how-to-get-the-api-key/%2$s', 'flexible-shipping-fedex'), '<a href="https://octolize.com/docs/article/fedex-how-to-get-the-api-key/" target="_blank" rel="noopener noreferrer">', '</a>'));
?><br/>
	<?php 
\esc_html_e(' - Enter the REST API credentials,', 'flexible-shipping-fedex');
?><br/>
	<?php 
\esc_html_e(' - Save the settings.', 'flexible-shipping-fedex');
?><br/>
	<?php 
\esc_html_e(' - Please complete the update before June 2026 to ensure uninterrupted FedEx live rates at checkout.', 'flexible-shipping-fedex');
?>
</p>

<p><?php 
\esc_html_e('Thank you for using FedEx Live Rates!', 'flexible-shipping-fedex');
?></p>
<?php 
