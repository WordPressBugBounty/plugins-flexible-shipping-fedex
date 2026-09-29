<?php
/**
 * Settings sidebar.
 *
 * @package WPDesk\FlexibleShippingFedex
 */

namespace WPDesk\FlexibleShippingFedex;

use FedExVendor\Octolize\Brand\Assets\AdminAssets;
use FedExVendor\Octolize\Brand\UpgradeBox\SettingsSidebarBox;
use FedExVendor\Octolize\Brand\UpsellingBox\ShippingMethodInstanceShouldShowStrategy;
use FedExVendor\WPDesk\FedexShippingService\FedexShippingService;
use FedExVendor\WPDesk\PluginBuilder\Plugin\Hookable;
use FedExVendor\WPDesk\PluginBuilder\Plugin\HookableCollection;
use FedExVendor\WPDesk\PluginBuilder\Plugin\HookableParent;
use FedExVendor\WPDesk\ShowDecision\OrStrategy;
use FedExVendor\WPDesk\ShowDecision\WooCommerce\ShippingMethodStrategy;
use WPDesk\FlexibleShippingFedex\Upselling\FedexProOffer;

/**
 * Can display settings sidebar.
 */
class SettingsSidebar implements Hookable, HookableCollection {

	use HookableParent;

	private string $assets_url;

	public function __construct( string $assets_url ) {
		$this->assets_url = $assets_url;
	}

	/**
	 * Hooks.
	 */
	public function hooks() {
		$should_show_strategy = new OrStrategy( new ShippingMethodStrategy( FedexShippingService::UNIQUE_ID ) );
		$should_show_strategy->addCondition( new ShippingMethodInstanceShouldShowStrategy( new \WC_Shipping_Zones(), FedexShippingService::UNIQUE_ID ) );
		$this->add_hookable( new AdminAssets( $this->assets_url, 'fedex', $should_show_strategy ) );
		$upgrade_url      = 'pl_PL' === get_locale() ? 'https://octol.io/fedex-upgrade-box-pl' : 'https://octol.io/fedex-upgrade-box';
		$settings_sidebar = new SettingsSidebarBox(
			'flexible_shipping_fedex_settings_sidebar',
			$should_show_strategy,
			( new FedexProOffer() )->create( $upgrade_url ),
			[
				'min_width'            => 1200,
				'position_right'       => 20,
				'align_top_to_element' => '#mainform h2:first,#mainform h3:first',
			]
		);
		$this->add_hookable( $settings_sidebar );

		$this->hooks_on_hookable_objects();
	}
}
