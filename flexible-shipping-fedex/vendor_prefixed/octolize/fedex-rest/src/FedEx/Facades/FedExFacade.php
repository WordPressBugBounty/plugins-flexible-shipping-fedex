<?php

namespace FedExVendor\CageA80\FedEx\Facades;

use FedExVendor\Illuminate\Support\Facades\Facade;
class FedExFacade extends \FedExVendor\Illuminate\Support\Facades\Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'fedex-rest';
    }
}
