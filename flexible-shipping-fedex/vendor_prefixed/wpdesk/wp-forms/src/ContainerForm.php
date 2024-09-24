<?php

namespace FedExVendor\WPDesk\Forms;

use FedExVendor\Psr\Container\ContainerInterface;
use FedExVendor\WPDesk\Persistence\PersistentContainer;
/**
 * Persistent container support for forms.
 *
 * @package WPDesk\Forms
 */
interface ContainerForm
{
    /**
     * @param ContainerInterface $data
     *
     * @return void
     */
    public function set_data(\FedExVendor\Psr\Container\ContainerInterface $data);
    /**
     * Put data from form into a container.
     *
     * @return void
     */
    public function put_data(\FedExVendor\WPDesk\Persistence\PersistentContainer $container);
}
