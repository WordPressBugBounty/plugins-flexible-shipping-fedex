<?php

namespace FedExVendor\WPDesk\FedexShippingService\FedexApi\Soap;

use FedExVendor\FedEx\RateService\ComplexType\RateReply;
use FedExVendor\FedEx\RateService\ComplexType\RateRequest;
/**
 * Sender class interface.
 *
 * @package WPDesk\FedexShippingService\FedexApi
 */
interface Sender
{
    /**
     * Send request.
     *
     * @param RateRequest $request Request.
     *
     * @return RateReply
     */
    public function send(RateRequest $request);
}
