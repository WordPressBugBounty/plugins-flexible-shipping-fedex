<?php

namespace FedExVendor\Illuminate\Support\Traits;

use FedExVendor\Illuminate\Container\Container;
trait Localizable
{
    /**
     * Run the callback with the given locale.
     *
     * @param  string  $locale
     * @param  \Closure  $callback
     * @return mixed
     */
    public function withLocale($locale, $callback)
    {
        if (!$locale) {
            return $callback();
        }
        $app = \FedExVendor\Illuminate\Container\Container::getInstance();
        $original = $app->getLocale();
        try {
            $app->setLocale($locale);
            return $callback();
        } finally {
            $app->setLocale($original);
        }
    }
}
