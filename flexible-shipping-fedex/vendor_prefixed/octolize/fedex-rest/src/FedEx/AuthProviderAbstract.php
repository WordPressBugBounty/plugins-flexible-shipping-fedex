<?php

namespace FedExVendor\CageA80\FedEx;

use FedExVendor\CageA80\FedEx\Services\Auth\AuthRequest;
abstract class AuthProviderAbstract implements \FedExVendor\CageA80\FedEx\Contracts\AuthProvider
{
    protected array $config = [];
    public function __construct(array $config = [])
    {
        $this->config = $config;
    }
    abstract public function getToken(): string;
    abstract public function flush(): void;
}
