<?php

namespace FedExVendor\GuzzleHttp;

use FedExVendor\Psr\Http\Message\MessageInterface;
interface BodySummarizerInterface
{
    /**
     * Returns a summarized message body.
     */
    public function summarize(\FedExVendor\Psr\Http\Message\MessageInterface $message) : ?string;
}
