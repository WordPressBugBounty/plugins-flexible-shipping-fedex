<?php

namespace FedExVendor\CageA80\FedEx;

use FedExVendor\CageA80\FedEx\Contracts\AuthProvider as AuthProviderContract;
use FedExVendor\CageA80\FedEx\Contracts\HttpProvider;
use FedExVendor\CageA80\FedEx\Exceptions\FedExException;
use FedExVendor\CageA80\FedEx\Http\GuzzleHttpProvider;
use FedExVendor\CageA80\FedEx\Support\EnvironmentType;
use FedExVendor\Illuminate\Support\Str;
abstract class RequestAbstract
{
    const SANDBOX_SERVER = 'https://apis-sandbox.fedex.com';
    const PRODUCTION_SERVER = 'https://apis.fedex.com';
    protected array $config;
    protected ?\FedExVendor\CageA80\FedEx\Contracts\AuthProvider $auth = null;
    public function __construct(array $config = [])
    {
        $this->config = \array_merge(['environment' => \FedExVendor\CageA80\FedEx\Support\EnvironmentType::SANDBOX, 'provider' => \FedExVendor\CageA80\FedEx\Http\GuzzleHttpProvider::class, 'authProvider' => \FedExVendor\CageA80\FedEx\AuthProvider::class], $config);
    }
    protected function getHttpProvider(array $config = []) : \FedExVendor\CageA80\FedEx\Contracts\HttpProvider
    {
        $providerClassName = $this->config['provider'];
        if (\class_exists($providerClassName)) {
            $providerConfig = \array_merge(['base_uri' => $this->getApiEndpoint($this->config['environment'])], $this->config['providerConfig'] ?? [], $config);
            return new $providerClassName($providerConfig);
        }
        throw new \InvalidArgumentException('Unknown HttpProvider class name: ' . $providerClassName);
    }
    protected function getApiEndpoint(string $environment) : string
    {
        switch ($environment) {
            case \FedExVendor\CageA80\FedEx\Support\EnvironmentType::PRODUCTION:
                return static::PRODUCTION_SERVER;
            case \FedExVendor\CageA80\FedEx\Support\EnvironmentType::SANDBOX:
                return static::SANDBOX_SERVER;
            case \FedExVendor\CageA80\FedEx\Support\EnvironmentType::MOCK:
                return $this->config['mockEndpoint'];
        }
        throw new \Exception('Unknown server environment: ' . $environment);
    }
    protected function request(callable $method)
    {
        $attempts = $this->config['attempts'] ?? 1;
        while ($attempts >= 0) {
            try {
                //                logger()->debug(get_class($this) . ': attempts left: ' . $attempts);
                $attempts--;
                return \call_user_func($method);
            } catch (\FedExVendor\CageA80\FedEx\Exceptions\FedExException $e) {
                if (!$attempts) {
                    throw $e;
                }
                switch ($e->getCode()) {
                    case 500:
                    // Failure: INTERNAL.SERVER.ERROR
                    case 503:
                        // Service unavailable: SERVICE.UNAVAILABLE.ERROR
                        // Just continue to the next iteration
                        continue 2;
                    case 401:
                        // Unauthorized: NOT.AUTHORIZED.ERROR
                        // Reset authentication token and retry
                        $this->getAuthProvider()->flush();
                        continue 2;
                    case 400:
                        // BAD.REQUEST.ERROR
                        // On a wrong token FedEx responses with a 400 error instead of 401,
                        // so we need to handle it. And it seems there is no better way to
                        // do it rather than identify this error by error message (FedEx, what?)
                        if (\FedExVendor\Illuminate\Support\Str::startsWith($e->getMessage(), 'The given JWT is invalid')) {
                            $this->getAuthProvider()->flush();
                            continue 2;
                        }
                        throw $e;
                    default:
                        // In all other cases let the exception to fall through
                        throw $e;
                }
            }
        }
        return null;
    }
    protected function getAuthProvider() : \FedExVendor\CageA80\FedEx\Contracts\AuthProvider
    {
        if (!$this->auth) {
            $authProviderClass = $this->config['authProvider'];
            if (!\class_exists($authProviderClass)) {
                throw new \FedExVendor\CageA80\FedEx\Exceptions\FedExException('Cannot find auth provider class: ' . $authProviderClass);
            }
            $this->auth = new $authProviderClass($this->config);
        }
        return $this->auth;
    }
    protected function getApiToken() : string
    {
        if (isset($this->config['token'])) {
            return $this->config['token'];
        }
        return $this->getAuthProvider()->getToken();
    }
}
