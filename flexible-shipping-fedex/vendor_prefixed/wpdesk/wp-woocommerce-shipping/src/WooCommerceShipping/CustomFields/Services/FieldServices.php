<?php

/**
 * Custom fields: FieldServices class.
 *
 * @package WPDesk\WooCommerceShipping\CustomFields
 */
namespace FedExVendor\WPDesk\WooCommerceShipping\CustomFields\Services;

use FedExVendor\WPDesk\WooCommerceShipping\CustomFields\CustomField;
/**
 * Render view for custom services field
 *
 * @package WPDesk\CustomFields
 */
class FieldServices implements CustomField
{
    const FIELD_TYPE = 'services';
    /**
     * Services.
     *
     * @var array
     */
    private $services;
    /**
     * FieldServices constructor.
     *
     * @param array $services .
     */
    public function __construct(array $services)
    {
        $this->services = $services;
    }
    /**
     * Unique field name.
     *
     * @return string .
     */
    public static function get_type_name()
    {
        return self::FIELD_TYPE;
    }
    /**
     * Can sanitize data so it can be saved into DB.
     *
     * @param mixed $data
     *
     * @return mixed
     */
    public function sanitize(array $data = null)
    {
        $sanitizer = new FieldServicesSanitizer();
        return $sanitizer->sanitize_services($data);
    }
    /**
     * Sort services.
     *
     * @param array $options Services from field definition.
     * @param array $values Services from settings.
     *
     * @return array
     */
    private function sort_services($options, $values)
    {
        foreach ($values as $key => $value) {
            if (!isset($options[$key])) {
                unset($values[$key]);
            }
        }
        foreach ($options as $key => $service) {
            if (!isset($values[$key])) {
                $values[$key] = $service;
            }
        }
        return $values;
    }
    /**
     * Render view.
     *
     * @param array|null $params Params.
     * @param \WC_Shipping_Method|null $shipping_method Shipping method.
     *
     * @return string.
     */
    public function render(array $params = null, $shipping_method = null)
    {
        $services = $this->services;
        if (empty($params['class'])) {
            $params['class'] = '';
        }
        if (!empty($params['value'])) {
            if (!is_array($params['value'])) {
                $params['value'] = array();
            }
            $services = $this->sort_services($services, $params['value']);
        }
        $tooltip_html = $shipping_method ? $shipping_method->get_tooltip_html($params) : '';
        $description_html = $shipping_method ? $shipping_method->get_description_html($params) : '';
        ob_start();
        include __DIR__ . '/views/services.php';
        return ob_get_clean();
    }
    /**
     * Field can render some data after all fields was successfully rendered.
     *
     * @param string $key Rendered field key/name.
     *
     * @return string|void Rendered footer.
     */
    public function render_footer($key)
    {
    }
    public static function convert_services_to_settings_services(array $services): array
    {
        $settings_services = [];
        foreach ($services as $service_id => $service) {
            $settings_services[$service_id] = ['name' => $service, 'enabled' => $service_id];
        }
        return $settings_services;
    }
}
