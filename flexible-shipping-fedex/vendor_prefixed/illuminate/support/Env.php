<?php

namespace FedExVendor\Illuminate\Support;

use FedExVendor\Dotenv\Repository\Adapter\PutenvAdapter;
use FedExVendor\Dotenv\Repository\RepositoryBuilder;
use FedExVendor\PhpOption\Option;
class Env
{
    /**
     * Indicates if the putenv adapter is enabled.
     *
     * @var bool
     */
    protected static $putenv = \true;
    /**
     * The environment repository instance.
     *
     * @var \Dotenv\Repository\RepositoryInterface|null
     */
    protected static $repository;
    /**
     * Enable the putenv adapter.
     *
     * @return void
     */
    public static function enablePutenv()
    {
        static::$putenv = \true;
        static::$repository = null;
    }
    /**
     * Disable the putenv adapter.
     *
     * @return void
     */
    public static function disablePutenv()
    {
        static::$putenv = \false;
        static::$repository = null;
    }
    /**
     * Get the environment repository instance.
     *
     * @return \Dotenv\Repository\RepositoryInterface
     */
    public static function getRepository()
    {
        if (static::$repository === null) {
            $builder = RepositoryBuilder::createWithDefaultAdapters();
            if (static::$putenv) {
                $builder = $builder->addAdapter(PutenvAdapter::class);
            }
            static::$repository = $builder->immutable()->make();
        }
        return static::$repository;
    }
    /**
     * Gets the value of an environment variable.
     *
     * @param  string  $key
     * @param  mixed  $default
     * @return mixed
     */
    public static function get($key, $default = null)
    {
        return Option::fromValue(static::getRepository()->get($key))->map(function ($value) {
            switch (strtolower($value)) {
                case 'true':
                case '(true)':
                    return \true;
                case 'false':
                case '(false)':
                    return \false;
                case 'empty':
                case '(empty)':
                    return '';
                case 'null':
                case '(null)':
                    return;
            }
            if (preg_match('/\A([\'"])(.*)\1\z/', $value, $matches)) {
                return $matches[2];
            }
            return $value;
        })->getOrCall(function () use ($default) {
            return value($default);
        });
    }
}
