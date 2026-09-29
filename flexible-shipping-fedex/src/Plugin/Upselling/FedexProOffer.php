<?php
/**
 * FedEx PRO offer.
 *
 * @package WPDesk\FlexibleShippingFedex\Upselling
 */

declare( strict_types=1 );

namespace WPDesk\FlexibleShippingFedex\Upselling;

/**
 * Provides the FedEx PRO offer for the free plugin.
 */
final class FedexProOffer {

	/**
	 * Creates the localized offer data.
	 *
	 * @param string $url Upgrade URL.
	 *
	 * @return array<string, mixed>
	 */
	public function create( string $url ): array {
		return [
			'eyebrow'      => __( 'FedEx PRO', 'flexible-shipping-fedex' ),
			'headline'     => __( 'Know exactly when the FedEx parcel will arrive', 'flexible-shipping-fedex' ),
			'description'  => __( 'The free version calculates live FedEx rates. PRO adds an estimated delivery date and FedEx Freight LTL support.', 'flexible-shipping-fedex' ),
			'current'      => [
				'label' => __( 'Price only', 'flexible-shipping-fedex' ),
				'badge' => __( 'NOW', 'flexible-shipping-fedex' ),
			],
			'upgrade'      => [
				'label' => __( 'Price + delivery estimate', 'flexible-shipping-fedex' ),
				'badge' => __( 'PRO', 'flexible-shipping-fedex' ),
			],
			'benefits'     => [
				[
					'icon' => 'calendar',
					'text' => __( 'Show a delivery estimate that accounts for transit time and cutoff', 'flexible-shipping-fedex' ),
				],
				[
					'icon' => 'box',
					'text' => __( 'Handle heavier shipments with FedEx Freight LTL support', 'flexible-shipping-fedex' ),
				],
				[
					'icon' => 'percent',
					'text' => __( 'Automatic carton packing based on weight and volume', 'flexible-shipping-fedex' ),
				],
			],
			'social_proof' => __( 'Trusted by 250,000+ WooCommerce stores', 'flexible-shipping-fedex' ),
			'guarantee'    => __( '30-day money-back guarantee - risk-free', 'flexible-shipping-fedex' ),
			'cta_label'    => __( 'Unlock freight', 'flexible-shipping-fedex' ),
			'cta_url'      => $url,
		];
	}
}
