<?php

namespace FedExVendor\GuzzleHttp;

use FedExVendor\Psr\Http\Message\MessageInterface;
final class BodySummarizer implements \FedExVendor\GuzzleHttp\BodySummarizerInterface
{
    /**
     * @var int|null
     */
    private $truncateAt;
    public function __construct(int $truncateAt = null)
    {
        $this->truncateAt = $truncateAt;
    }
    /**
     * Returns a summarized message body.
     */
    public function summarize(\FedExVendor\Psr\Http\Message\MessageInterface $message) : ?string
    {
        return $this->truncateAt === null ? \FedExVendor\GuzzleHttp\Psr7\Message::bodySummary($message) : \FedExVendor\GuzzleHttp\Psr7\Message::bodySummary($message, $this->truncateAt);
    }
}
