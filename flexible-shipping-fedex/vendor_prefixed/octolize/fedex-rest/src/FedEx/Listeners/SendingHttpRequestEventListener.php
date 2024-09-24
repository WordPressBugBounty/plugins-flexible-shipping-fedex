<?php

namespace FedExVendor\CageA80\FedEx\Listeners;

use FedExVendor\CageA80\FedEx\Events\SendingHttpRequest;
/**
 * Class SendingHttpRequestEventListener
 *
 * @package CageA80\FedEx\Listeners
 */
class SendingHttpRequestEventListener extends \FedExVendor\CageA80\FedEx\Listeners\BaseEventListener
{
    /**
     * Handle the event.
     *
     * @param $event
     * @return void
     */
    public function handle(\FedExVendor\CageA80\FedEx\Events\SendingHttpRequest $event)
    {
        if ($logger = $this->getLogger()) {
            $logger->info('FedEx request: ' . $event->url);
            $logger->info(\print_r(['headers' => $event->headers, 'payload' => $event->data], \true));
        }
    }
}
