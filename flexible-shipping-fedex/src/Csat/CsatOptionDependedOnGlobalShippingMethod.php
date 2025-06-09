<?php

namespace WPDesk\FlexibleShippingFedex\Csat;

use FedExVendor\Octolize\Csat\CsatOptionDependedOnShippingMethod;

class CsatOptionDependedOnGlobalShippingMethod extends CsatOptionDependedOnShippingMethod {

	private string $shipping_method_id;

	public function __construct( string $option_name, string $shipping_method_id ) {
		parent::__construct( $option_name, $shipping_method_id );
		$this->shipping_method_id = $shipping_method_id;
	}

	public function hooks(): void {
		add_filter( 'woocommerce_settings_api_sanitized_fields_' . $this->shipping_method_id, [ $this, 'update_settings' ] );
	}
}
