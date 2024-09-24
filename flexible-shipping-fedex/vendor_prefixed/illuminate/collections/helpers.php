<?php

namespace FedExVendor\Illuminate\Support;

use FedExVendor\Illuminate\Support\Arr;
use FedExVendor\Illuminate\Support\Collection;
if (!\function_exists('FedExVendor\\Illuminate\\Support\\collect')) {
    /**
     * Create a collection from the given value.
     *
     * @param  mixed  $value
     * @return \Illuminate\Support\Collection
     */
    function collect($value = null)
    {
        return new \FedExVendor\Illuminate\Support\Collection($value);
    }
}
if (!\function_exists('FedExVendor\\Illuminate\\Support\\data_fill')) {
    /**
     * Fill in data where it's missing.
     *
     * @param  mixed  $target
     * @param  string|array  $key
     * @param  mixed  $value
     * @return mixed
     */
    function data_fill(&$target, $key, $value)
    {
        return \FedExVendor\data_set($target, $key, $value, \false);
    }
}
if (!\function_exists('FedExVendor\\Illuminate\\Support\\data_get')) {
    /**
     * Get an item from an array or object using "dot" notation.
     *
     * @param  mixed  $target
     * @param  string|array|int|null  $key
     * @param  mixed  $default
     * @return mixed
     */
    function data_get($target, $key, $default = null)
    {
        if (\is_null($key)) {
            return $target;
        }
        $key = \is_array($key) ? $key : \explode('.', $key);
        foreach ($key as $i => $segment) {
            unset($key[$i]);
            if (\is_null($segment)) {
                return $target;
            }
            if ($segment === '*') {
                if ($target instanceof \FedExVendor\Illuminate\Support\Collection) {
                    $target = $target->all();
                } elseif (!\is_array($target)) {
                    return \FedExVendor\value($default);
                }
                $result = [];
                foreach ($target as $item) {
                    $result[] = \FedExVendor\data_get($item, $key);
                }
                return \in_array('*', $key) ? \FedExVendor\Illuminate\Support\Arr::collapse($result) : $result;
            }
            if (\FedExVendor\Illuminate\Support\Arr::accessible($target) && \FedExVendor\Illuminate\Support\Arr::exists($target, $segment)) {
                $target = $target[$segment];
            } elseif (\is_object($target) && isset($target->{$segment})) {
                $target = $target->{$segment};
            } else {
                return \FedExVendor\value($default);
            }
        }
        return $target;
    }
}
if (!\function_exists('FedExVendor\\Illuminate\\Support\\data_set')) {
    /**
     * Set an item on an array or object using dot notation.
     *
     * @param  mixed  $target
     * @param  string|array  $key
     * @param  mixed  $value
     * @param  bool  $overwrite
     * @return mixed
     */
    function data_set(&$target, $key, $value, $overwrite = \true)
    {
        $segments = \is_array($key) ? $key : \explode('.', $key);
        if (($segment = \array_shift($segments)) === '*') {
            if (!\FedExVendor\Illuminate\Support\Arr::accessible($target)) {
                $target = [];
            }
            if ($segments) {
                foreach ($target as &$inner) {
                    \FedExVendor\data_set($inner, $segments, $value, $overwrite);
                }
            } elseif ($overwrite) {
                foreach ($target as &$inner) {
                    $inner = $value;
                }
            }
        } elseif (\FedExVendor\Illuminate\Support\Arr::accessible($target)) {
            if ($segments) {
                if (!\FedExVendor\Illuminate\Support\Arr::exists($target, $segment)) {
                    $target[$segment] = [];
                }
                \FedExVendor\data_set($target[$segment], $segments, $value, $overwrite);
            } elseif ($overwrite || !\FedExVendor\Illuminate\Support\Arr::exists($target, $segment)) {
                $target[$segment] = $value;
            }
        } elseif (\is_object($target)) {
            if ($segments) {
                if (!isset($target->{$segment})) {
                    $target->{$segment} = [];
                }
                \FedExVendor\data_set($target->{$segment}, $segments, $value, $overwrite);
            } elseif ($overwrite || !isset($target->{$segment})) {
                $target->{$segment} = $value;
            }
        } else {
            $target = [];
            if ($segments) {
                \FedExVendor\data_set($target[$segment], $segments, $value, $overwrite);
            } elseif ($overwrite) {
                $target[$segment] = $value;
            }
        }
        return $target;
    }
}
if (!\function_exists('FedExVendor\\Illuminate\\Support\\head')) {
    /**
     * Get the first element of an array. Useful for method chaining.
     *
     * @param  array  $array
     * @return mixed
     */
    function head($array)
    {
        return \reset($array);
    }
}
if (!\function_exists('FedExVendor\\Illuminate\\Support\\last')) {
    /**
     * Get the last element from an array.
     *
     * @param  array  $array
     * @return mixed
     */
    function last($array)
    {
        return \end($array);
    }
}
if (!\function_exists('FedExVendor\\Illuminate\\Support\\value')) {
    /**
     * Return the default value of the given value.
     *
     * @param  mixed  $value
     * @return mixed
     */
    function value($value, ...$args)
    {
        return $value instanceof \Closure ? $value(...$args) : $value;
    }
}
