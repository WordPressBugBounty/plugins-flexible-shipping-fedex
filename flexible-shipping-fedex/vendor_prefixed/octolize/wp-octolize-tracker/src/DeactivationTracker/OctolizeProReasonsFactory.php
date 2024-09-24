<?php

namespace FedExVendor\Octolize\Tracker\DeactivationTracker;

use FedExVendor\WPDesk\Tracker\Deactivation\Reason;
use FedExVendor\WPDesk\Tracker\Deactivation\ReasonsFactory;
class OctolizeProReasonsFactory implements \FedExVendor\WPDesk\Tracker\Deactivation\ReasonsFactory
{
    private \FedExVendor\Octolize\Tracker\DeactivationTracker\OctolizeReasonsFactory $reasons_factory;
    public function __construct(string $plugin_docs_url = '', string $contact_us_url = '')
    {
        $this->reasons_factory = new \FedExVendor\Octolize\Tracker\DeactivationTracker\OctolizeReasonsFactory($plugin_docs_url, '', '', $contact_us_url);
    }
    /**
     * Create reasons.
     *
     * @return Reason[]
     */
    public function createReasons() : array
    {
        $reasons = $this->reasons_factory->createReasons();
        $reasons[\FedExVendor\Octolize\Tracker\DeactivationTracker\OctolizeReasonsFactory::MISSING_FEATURE]->setDescription(\__('Can you let us know, what functionality you\'re looking for?', 'flexible-shipping-fedex'));
        return $reasons;
    }
}
