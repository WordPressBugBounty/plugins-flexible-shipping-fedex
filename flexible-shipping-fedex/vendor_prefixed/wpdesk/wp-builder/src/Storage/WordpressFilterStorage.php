<?php

namespace FedExVendor\WPDesk\PluginBuilder\Storage;

use FedExVendor\WPDesk\PluginBuilder\Plugin\AbstractPlugin;
/**
 * Can store plugin instances in WordPress filter system.
 *
 * @package WPDesk\PluginBuilder\Storage
 */
class WordpressFilterStorage implements PluginStorage
{
    const STORAGE_FILTER_NAME = 'wpdesk_plugin_instances';
    /**
     * @param string $class
     * @param AbstractPlugin $object
     */
    public function add_to_storage($class, $object)
    {
        add_filter(self::STORAGE_FILTER_NAME, static function ($plugins) use ($class, $object) {
            if (isset($plugins[$class])) {
                throw new Exception\ClassAlreadyExists("Class {$class} already exists");
            }
            $plugins[$class] = $object;
            return $plugins;
        });
    }
    /**
     * @param string $class
     *
     * @return AbstractPlugin
     */
    public function get_from_storage($class)
    {
        $plugins = apply_filters(self::STORAGE_FILTER_NAME, []);
        if (isset($plugins[$class])) {
            return $plugins[$class];
        }
        throw new Exception\ClassNotExists("Class {$class} not exists in storage");
    }
}
