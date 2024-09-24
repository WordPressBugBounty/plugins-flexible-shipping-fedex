<?php

namespace FedExVendor\Illuminate\Support\Testing\Fakes;

use Closure;
use FedExVendor\Illuminate\Foundation\Bus\PendingChain;
use FedExVendor\Illuminate\Queue\CallQueuedClosure;
class PendingChainFake extends \FedExVendor\Illuminate\Foundation\Bus\PendingChain
{
    /**
     * The fake bus instance.
     *
     * @var \Illuminate\Support\Testing\Fakes\BusFake
     */
    protected $bus;
    /**
     * Create a new pending chain instance.
     *
     * @param  \Illuminate\Support\Testing\Fakes\BusFake  $bus
     * @param  mixed  $job
     * @param  array  $chain
     * @return void
     */
    public function __construct(\FedExVendor\Illuminate\Support\Testing\Fakes\BusFake $bus, $job, $chain)
    {
        $this->bus = $bus;
        $this->job = $job;
        $this->chain = $chain;
    }
    /**
     * Dispatch the job with the given arguments.
     *
     * @return \Illuminate\Foundation\Bus\PendingDispatch
     */
    public function dispatch()
    {
        if (\is_string($this->job)) {
            $firstJob = new $this->job(...\func_get_args());
        } elseif ($this->job instanceof \Closure) {
            $firstJob = \FedExVendor\Illuminate\Queue\CallQueuedClosure::create($this->job);
        } else {
            $firstJob = $this->job;
        }
        $firstJob->allOnConnection($this->connection);
        $firstJob->allOnQueue($this->queue);
        $firstJob->chain($this->chain);
        $firstJob->delay($this->delay);
        $firstJob->chainCatchCallbacks = $this->catchCallbacks();
        return $this->bus->dispatch($firstJob);
    }
}
