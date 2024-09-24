<?php

namespace FedExVendor\WPDesk\WooCommerceShipping\Fedex;

use FedExVendor\CageA80\FedEx\AuthProviderAbstract;
use FedExVendor\CageA80\FedEx\Services\Auth\AuthRequest;
class RestApiAuthProvider extends \FedExVendor\CageA80\FedEx\AuthProviderAbstract
{
    const CACHE_KEY = 'fs-fedex-token';
    public function getToken() : string
    {
        $token_from_option = \get_option(self::CACHE_KEY, []);
        if (\is_array($token_from_option) && isset($token_from_option['token']) && isset($token_from_option['expires_in'])) {
            $token = (string) $token_from_option['token'];
            $expires_in = (int) $token_from_option['expires_in'];
            if ($expires_in > \time()) {
                return $token;
            }
        }
        $key = $this->config['key'];
        $secret = $this->config['secret'];
        $service = new \FedExVendor\CageA80\FedEx\Services\Auth\AuthRequest($this->config);
        $response = $service->getToken($key, $secret);
        \update_option(self::CACHE_KEY, ['token' => $response->token(), 'expires_in' => \time() + $response->expiresIn() - 10]);
        return $response->token();
    }
    public function flush() : void
    {
        \delete_option(self::CACHE_KEY);
    }
}
