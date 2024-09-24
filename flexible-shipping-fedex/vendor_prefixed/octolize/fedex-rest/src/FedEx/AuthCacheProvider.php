<?php

namespace FedExVendor\CageA80\FedEx;

use FedExVendor\CageA80\FedEx\Services\Auth\AuthRequest;
use FedExVendor\Illuminate\Support\Facades\Cache;
class AuthCacheProvider extends \FedExVendor\CageA80\FedEx\AuthProviderAbstract
{
    const CACHE_KEY = 'fedex.token';
    public function getToken() : string
    {
        if ($token = \FedExVendor\Illuminate\Support\Facades\Cache::get(self::CACHE_KEY)) {
            return $token;
        }
        $key = $this->config['key'];
        $secret = $this->config['secret'];
        $service = new \FedExVendor\CageA80\FedEx\Services\Auth\AuthRequest($this->config);
        $response = $service->getToken($key, $secret);
        \FedExVendor\Illuminate\Support\Facades\Cache::add('fedex.token', $response->token(), $response->expiresIn() - 10);
        return \FedExVendor\Illuminate\Support\Facades\Cache::get('fedex.token');
    }
    public function flush() : void
    {
        \FedExVendor\Illuminate\Support\Facades\Cache::forget(self::CACHE_KEY);
    }
}
