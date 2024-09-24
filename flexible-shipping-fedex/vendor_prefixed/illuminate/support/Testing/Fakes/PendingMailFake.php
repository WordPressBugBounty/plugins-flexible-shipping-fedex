<?php

namespace FedExVendor\Illuminate\Support\Testing\Fakes;

use FedExVendor\Illuminate\Contracts\Mail\Mailable;
use FedExVendor\Illuminate\Mail\PendingMail;
class PendingMailFake extends \FedExVendor\Illuminate\Mail\PendingMail
{
    /**
     * Create a new instance.
     *
     * @param  \Illuminate\Support\Testing\Fakes\MailFake  $mailer
     * @return void
     */
    public function __construct($mailer)
    {
        $this->mailer = $mailer;
    }
    /**
     * Send a new mailable message instance.
     *
     * @param  \Illuminate\Contracts\Mail\Mailable  $mailable
     * @return void
     */
    public function send(\FedExVendor\Illuminate\Contracts\Mail\Mailable $mailable)
    {
        $this->mailer->send($this->fill($mailable));
    }
    /**
     * Push the given mailable onto the queue.
     *
     * @param  \Illuminate\Contracts\Mail\Mailable  $mailable
     * @return mixed
     */
    public function queue(\FedExVendor\Illuminate\Contracts\Mail\Mailable $mailable)
    {
        return $this->mailer->queue($this->fill($mailable));
    }
}
