<?php

namespace FedExVendor\CageA80\FedEx\Services\Auth;

use FedExVendor\CageA80\FedEx\RequestAbstract;
use FedExVendor\CageA80\FedEx\Support\AuthGrantType;
use FedExVendor\CageA80\FedEx\Support\Endpoint;
/**
 * Class Auth
 *
 * $config = [
 *  'environment' => EnvironmentType::SANDBOX | EnvironmentType::PRODUCTION,
 *  'provider' => 'curl',
 *  'authGrantType' => AuthGrantType::CLIENT | AuthGrantType::CSP,
 * ]
 *
 * @package FedEx
 */
class AuthRequest extends \FedExVendor\CageA80\FedEx\RequestAbstract
{
    public function getToken(string $apiKey, string $secretKey) : \FedExVendor\CageA80\FedEx\Services\Auth\AuthResponse
    {
        return $this->request(function () use($apiKey, $secretKey) {
            $response = $this->getHttpProvider($this->config['providerConfig'] ?? [])->post(\FedExVendor\CageA80\FedEx\Support\Endpoint::AUTH, ['form_params' => ['grant_type' => $this->config['authGrantType'] ?? \FedExVendor\CageA80\FedEx\Support\AuthGrantType::CLIENT, 'client_id' => $apiKey, 'client_secret' => $secretKey]], ['Accept' => 'application/json']);
            return new \FedExVendor\CageA80\FedEx\Services\Auth\AuthResponse($response['access_token'], $response['expires_in']);
        });
    }
}
