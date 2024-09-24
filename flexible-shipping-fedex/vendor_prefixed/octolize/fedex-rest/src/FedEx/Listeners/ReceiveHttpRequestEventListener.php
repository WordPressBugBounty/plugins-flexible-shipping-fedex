<?php

namespace FedExVendor\CageA80\FedEx\Listeners;

use FedExVendor\CageA80\FedEx\Events\ReceiveHttpRequest;
/**
 * Class SendingHttpRequestEventListener
 *
 * @package CageA80\FedEx\Listeners
 */
class ReceiveHttpRequestEventListener extends \FedExVendor\CageA80\FedEx\Listeners\BaseEventListener
{
    /**
     * Handle the event.
     *
     * @param $event
     * @return void
     */
    public function handle(\FedExVendor\CageA80\FedEx\Events\ReceiveHttpRequest $event)
    {
        if ($logger = $this->getLogger()) {
            $logger->info('FedEx response: ' . $event->url);
            $logger->info(\print_r(['response' => $event->response], \true));
        }
    }
}
