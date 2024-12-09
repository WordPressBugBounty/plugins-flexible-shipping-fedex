<?php

/**
 * Trait with ShippingService static injection
 *
 * @package WPDesk\WooCommerceShipping\ShippingMethod\Traits
 */
namespace FedExVendor\WPDesk\WooCommerceShipping\ShippingMethod\Traits;

use FedExVendor\Psr\Log\LoggerInterface;
use FedExVendor\Psr\Log\NullLogger;
use FedExVendor\WPDesk\AbstractShipping\ShippingService;
use FedExVendor\WPDesk\WooCommerceShipping\DisplayNoticeLogger;
use FedExVendor\WPDesk\WooCommerceShipping\ShippingMethod;
/**
 * Facilitates access to ShippingService abstract class with rates.
 *
 * @package WPDesk\WooCommerceShipping\ShippingMethod\Traits
 */
trait ShippingServiceTrait
{
    /**
     * @var LoggerInterface
     */
    private $service_logger;
    /**
     * @param ShippingMethod $shipping_method
     *
     * @return ShippingService
     */
    private function get_shipping_service(ShippingMethod $shipping_method)
    {
        return $shipping_method->get_plugin_shipping_decisions()->get_shipping_service();
    }
    /**
     * Initializes and injects logger into service.
     *
     * @param ShippingService $service
     *
     * @return LoggerInterface
     */
    private function inject_logger_into(ShippingService $service)
    {
        $logger = $this->get_service_logger($service);
        $service->setLogger($logger);
        return $logger;
    }
    /**
     * @param ShippingService $service
     *
     * @return LoggerInterface
     */
    private function get_service_logger(ShippingService $service)
    {
        if (null === $this->service_logger) {
            if ($this->can_see_logs()) {
                $this->service_logger = new DisplayNoticeLogger($this->get_logger($this), $service->get_name(), $this->instance_id);
            } else {
                $this->service_logger = $this->get_logger($this);
            }
        }
        return $this->service_logger;
    }
}
