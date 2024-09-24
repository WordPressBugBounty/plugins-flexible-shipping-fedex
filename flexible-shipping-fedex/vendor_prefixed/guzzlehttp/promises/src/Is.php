<?php

declare (strict_types=1);
namespace FedExVendor\GuzzleHttp\Promise;

final class Is
{
    /**
     * Returns true if a promise is pending.
     */
    public static function pending(\FedExVendor\GuzzleHttp\Promise\PromiseInterface $promise) : bool
    {
        return $promise->getState() === \FedExVendor\GuzzleHttp\Promise\PromiseInterface::PENDING;
    }
    /**
     * Returns true if a promise is fulfilled or rejected.
     */
    public static function settled(\FedExVendor\GuzzleHttp\Promise\PromiseInterface $promise) : bool
    {
        return $promise->getState() !== \FedExVendor\GuzzleHttp\Promise\PromiseInterface::PENDING;
    }
    /**
     * Returns true if a promise is fulfilled.
     */
    public static function fulfilled(\FedExVendor\GuzzleHttp\Promise\PromiseInterface $promise) : bool
    {
        return $promise->getState() === \FedExVendor\GuzzleHttp\Promise\PromiseInterface::FULFILLED;
    }
    /**
     * Returns true if a promise is rejected.
     */
    public static function rejected(\FedExVendor\GuzzleHttp\Promise\PromiseInterface $promise) : bool
    {
        return $promise->getState() === \FedExVendor\GuzzleHttp\Promise\PromiseInterface::REJECTED;
    }
}
