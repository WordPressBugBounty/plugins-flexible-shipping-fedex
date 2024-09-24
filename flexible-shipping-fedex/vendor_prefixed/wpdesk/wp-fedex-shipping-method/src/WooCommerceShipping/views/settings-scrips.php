<script type="text/javascript">
	jQuery( function($) {
		let $checkbox_field = jQuery('#woocommerce_flexible_shipping_fedex_enable_shipping_method');
		let description = $checkbox_field.data( 'description' );
		if ( description ) {
			$checkbox_field.parent().parent().append("<p class=\"description\">" + description + "</p>");
		}

		const $api_type = jQuery('#woocommerce_flexible_shipping_fedex_api_type');

		function change_api_type() {
			const val = $api_type.val();
			const $soap_api_fields = jQuery('.api-soap').closest('tr');
			const $rest_api_fields = jQuery('.api-rest').closest('tr');
			const $soap_api_inputs = $soap_api_fields.find('input:not([type="checkbox"]),select');
			const $rest_api_inputs = $rest_api_fields.find('input:not([type="checkbox"]),select');
			if ( val === 'soap' ) {
				$rest_api_fields.hide();
				$soap_api_fields.show();
				$rest_api_inputs.prop('required', false);
				$soap_api_inputs.prop('required', true);
			} else {
				$soap_api_fields.hide();
				$rest_api_fields.show();
				$soap_api_inputs.prop('required', false);
				$rest_api_inputs.prop('required', true);
			}
		}

		$api_type.change(function(){
			change_api_type();
		})

		change_api_type();

	} );
</script>

