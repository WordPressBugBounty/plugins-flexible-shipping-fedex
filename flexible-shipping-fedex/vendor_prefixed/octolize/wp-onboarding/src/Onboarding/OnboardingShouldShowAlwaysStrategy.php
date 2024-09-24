<?php

/**
 * @package Octolize\Onboarding
 */
namespace FedExVendor\Octolize\Onboarding;

/**
 * Always display strategy.
 */
class OnboardingShouldShowAlwaysStrategy implements \FedExVendor\Octolize\Onboarding\OnboardingShouldShowStrategy
{
    public function should_display() : bool
    {
        return \true;
    }
}
