<?php

/**
 * @package Octolize\Onboarding
 */
namespace FedExVendor\Octolize\Onboarding;

/**
 * Never display strategy.
 */
class OnboardingShouldShowNeverStrategy implements \FedExVendor\Octolize\Onboarding\OnboardingShouldShowStrategy
{
    public function should_display() : bool
    {
        return \false;
    }
}
