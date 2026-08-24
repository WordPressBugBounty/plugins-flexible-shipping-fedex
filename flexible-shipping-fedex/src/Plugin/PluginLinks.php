<?php

namespace WPDesk\FlexibleShippingFedex;

use FedExVendor\WPDesk\PluginBuilder\Plugin\Hookable;

class PluginLinks implements Hookable {

	private $plugin_file;

	public function __construct( $plugin_file ) {
		$this->plugin_file = $plugin_file;
	}

	public function hooks() {
		add_filter( 'plugin_row_meta', [ $this, 'plugin_row_meta' ], 10, 4 );
	}

	public function plugin_row_meta( $plugin_meta, $plugin_file, $plugin_data, $status ) {
		if ( $plugin_file === $this->plugin_file ) {
			$is_pl        = 'pl_PL' === get_locale();
			$docs_link    = $is_pl ? 'https://octol.io/fedex-docs-pl' : 'https://octol.io/fedex-docs';
			$support_link = $is_pl ? 'https://octol.io/fedex-support-pl' : 'https://octol.io/fedex-support';

			$plugin_links = [
				'<a target="_blank" rel="noopener noreferrer" href="' . esc_url( 'https://octol.io/fedex-rate' ) . '" aria-label="' . esc_attr__( 'Rate FedEx Live Rates', 'flexible-shipping-fedex' ) . '" style="color:#ffb900;font-size:20px;text-decoration:none;">★★★★★</a>',
				'<a href="' . $docs_link . '" target="_blank">' . __( 'Docs', 'flexible-shipping-fedex' ) . '</a>',
				'<a href="' . $support_link . '" target="_blank">' . __( 'Support', 'flexible-shipping-fedex' ) . '</a>',
			];

			return array_merge( $plugin_meta, $plugin_links );
		}

		return $plugin_meta;
	}
}
