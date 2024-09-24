<?php

namespace FedExVendor\Illuminate\Support;

use FedExVendor\Carbon\Carbon as BaseCarbon;
use FedExVendor\Carbon\CarbonImmutable as BaseCarbonImmutable;
class Carbon extends \FedExVendor\Carbon\Carbon
{
    /**
     * {@inheritdoc}
     */
    public static function setTestNow($testNow = null)
    {
        \FedExVendor\Carbon\Carbon::setTestNow($testNow);
        \FedExVendor\Carbon\CarbonImmutable::setTestNow($testNow);
    }
}
