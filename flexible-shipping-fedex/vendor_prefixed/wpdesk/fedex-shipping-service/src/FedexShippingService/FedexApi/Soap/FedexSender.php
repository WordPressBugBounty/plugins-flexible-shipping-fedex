<?php

namespace FedExVendor\WPDesk\FedexShippingService\FedexApi\Soap;

use FedExVendor\FedEx\RateService\ComplexType\RateReply;
use FedExVendor\FedEx\RateService\ComplexType\RateRequest;
use FedExVendor\FedEx\RateService\Request;
use FedExVendor\Psr\Log\LoggerInterface;
use FedExVendor\WPDesk\AbstractShipping\Exception\RateException;
/**
 * Send request to FedEx API
 *
 * @package WPDesk\FedexShippingService\FedexApi
 */
class FedexSender implements Sender
{
    /**
     * Logger
     *
     * @var LoggerInterface
     */
    private $logger;
    /**
     * Is testing?
     *
     * @var bool
     */
    private $is_testing;
    /**
     * FedexSender constructor.
     *
     * @param LoggerInterface $logger Logger.
     * @param bool $is_testing Is testing?.
     */
    public function __construct(LoggerInterface $logger, $is_testing = \true)
    {
        $this->logger = $logger;
        $this->is_testing = $is_testing;
    }
    /**
     * Get fedex URL.
     *
     * @return string
     */
    private function get_fedex_url()
    {
        return $this->is_testing ? Request::TESTING_URL : Request::PRODUCTION_URL;
    }
    /**
     * Formats XML.
     *
     * @param string $xml .
     *
     * @return string
     */
    private function format_xml($xml)
    {
        $xmlDocument = new \DOMDocument('1.0');
        $xmlDocument->preserveWhiteSpace = \false;
        $xmlDocument->formatOutput = \true;
        $xmlDocument->loadXML($xml);
        return $xmlDocument->saveXML();
    }
    /**
     * Log request and response.
     *
     * @param Request $rate_service_request .
     * @param string  $url .
     */
    private function log_request_and_response(Request $rate_service_request, $url)
    {
        $this->logger->info('API request', array('content' => $this->format_xml($rate_service_request->getSoapClient()->__getLastRequest()), 'url' => $url, 'headers' => $rate_service_request->getSoapClient()->__getLastRequestHeaders()));
        $this->logger->info('API response', array('content' => $this->format_xml($rate_service_request->getSoapClient()->__getLastResponse()), 'url' => $url, 'headers' => $rate_service_request->getSoapClient()->__getLastResponseHeaders()));
    }
    /**
     * Send request.
     *
     * @param RateRequest $request FedEx request.
     *
     * @return RateReply
     *
     * @throws RateException Rate exception.
     */
    public function send(RateRequest $request)
    {
        $rate_service_request = new Request();
        $url = $this->get_fedex_url();
        $rate_service_request->getSoapClient()->__setLocation($url);
        $reply = $rate_service_request->getGetRatesReply($request);
        $this->log_request_and_response($rate_service_request, $url);
        if (FedexSoapRateReplyInterpretation::has_reply_error($reply)) {
            throw new RateException(FedexSoapRateReplyInterpretation::get_reply_message($reply), ['response' => $reply]);
            //phpcs:ignore
        }
        return $reply;
    }
}
