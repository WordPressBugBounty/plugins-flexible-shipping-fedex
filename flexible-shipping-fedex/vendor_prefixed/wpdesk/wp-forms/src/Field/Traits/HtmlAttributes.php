<?php

namespace FedExVendor\WPDesk\Forms\Field\Traits;

use FedExVendor\WPDesk\Forms\Field;
use FedExVendor\WPDesk\Forms\Form;
/**
 * Implementation of HTML attributes like id, name, action etc.
 *
 * @package WPDesk\Forms\Field\Traits
 */
trait HtmlAttributes
{
    /** @var array{placeholder: string, name: string, id: string, class: string[]} */
    protected $attributes = [];
    /**
     * Get list of all attributes except given.
     *
     * @param string[] $except
     *
     * @return array<string[]|string|bool>
     */
    final public function get_attributes(array $except = ['name', 'class']): array
    {
        return array_filter($this->attributes, static function ($key) use ($except) {
            return !in_array($key, $except, \true);
        }, \ARRAY_FILTER_USE_KEY);
    }
    /**
     * @param string               $name
     * @param string[]|string|bool $value
     *
     * @return Field|Form
     */
    final public function set_attribute(string $name, $value)
    {
        $this->attributes[$name] = $value;
        return $this;
    }
    /**
     * @return HtmlAttributes
     */
    final public function unset_attribute(string $name)
    {
        unset($this->attributes[$name]);
        return $this;
    }
    final public function is_attribute_set(string $name): bool
    {
        return !empty($this->attributes[$name]);
    }
    final public function get_attribute(string $name, ?string $default = null): string
    {
        if (is_array($this->attributes[$name])) {
            // Be aware of coercing - if implode returns string(0) '', then return $default value.
            return implode(' ', $this->attributes[$name]) ?: $default ?? '';
        }
        return (string) ($this->attributes[$name] ?? $default ?? '');
    }
}
