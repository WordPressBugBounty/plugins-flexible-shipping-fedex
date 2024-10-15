<?php

namespace FedExVendor\Illuminate\Support;

use FedExVendor\Carbon\Carbon as BaseCarbon;
use FedExVendor\Carbon\CarbonImmutable as BaseCarbonImmutable;
class Carbon extends BaseCarbon
{
    /**
     * {@inheritdoc}
     */
    public static function setTestNow($testNow = null)
    {
        BaseCarbon::setTestNow($testNow);
        BaseCarbonImmutable::setTestNow($testNow);
    }
}
