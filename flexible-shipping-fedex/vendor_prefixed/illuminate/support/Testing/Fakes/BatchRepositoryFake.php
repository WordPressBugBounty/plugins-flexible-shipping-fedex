<?php

namespace FedExVendor\Illuminate\Support\Testing\Fakes;

use FedExVendor\Carbon\CarbonImmutable;
use Closure;
use FedExVendor\Illuminate\Bus\Batch;
use FedExVendor\Illuminate\Bus\BatchRepository;
use FedExVendor\Illuminate\Bus\PendingBatch;
use FedExVendor\Illuminate\Bus\UpdatedBatchJobCounts;
use FedExVendor\Illuminate\Support\Facades\Facade;
use FedExVendor\Illuminate\Support\Str;
class BatchRepositoryFake implements \FedExVendor\Illuminate\Bus\BatchRepository
{
    /**
     * Retrieve a list of batches.
     *
     * @param  int  $limit
     * @param  mixed  $before
     * @return \Illuminate\Bus\Batch[]
     */
    public function get($limit, $before)
    {
        return [];
    }
    /**
     * Retrieve information about an existing batch.
     *
     * @param  string  $batchId
     * @return \Illuminate\Bus\Batch|null
     */
    public function find(string $batchId)
    {
        //
    }
    /**
     * Store a new pending batch.
     *
     * @param  \Illuminate\Bus\PendingBatch  $batch
     * @return \Illuminate\Bus\Batch
     */
    public function store(\FedExVendor\Illuminate\Bus\PendingBatch $batch)
    {
        return new \FedExVendor\Illuminate\Bus\Batch(new \FedExVendor\Illuminate\Support\Testing\Fakes\QueueFake(\FedExVendor\Illuminate\Support\Facades\Facade::getFacadeApplication()), $this, (string) \FedExVendor\Illuminate\Support\Str::orderedUuid(), $batch->name, \count($batch->jobs), \count($batch->jobs), 0, [], $batch->options, \FedExVendor\Carbon\CarbonImmutable::now(), null, null);
    }
    /**
     * Increment the total number of jobs within the batch.
     *
     * @param  string  $batchId
     * @param  int  $amount
     * @return void
     */
    public function incrementTotalJobs(string $batchId, int $amount)
    {
        //
    }
    /**
     * Decrement the total number of pending jobs for the batch.
     *
     * @param  string  $batchId
     * @param  string  $jobId
     * @return \Illuminate\Bus\UpdatedBatchJobCounts
     */
    public function decrementPendingJobs(string $batchId, string $jobId)
    {
        return new \FedExVendor\Illuminate\Bus\UpdatedBatchJobCounts();
    }
    /**
     * Increment the total number of failed jobs for the batch.
     *
     * @param  string  $batchId
     * @param  string  $jobId
     * @return \Illuminate\Bus\UpdatedBatchJobCounts
     */
    public function incrementFailedJobs(string $batchId, string $jobId)
    {
        return new \FedExVendor\Illuminate\Bus\UpdatedBatchJobCounts();
    }
    /**
     * Mark the batch that has the given ID as finished.
     *
     * @param  string  $batchId
     * @return void
     */
    public function markAsFinished(string $batchId)
    {
        //
    }
    /**
     * Cancel the batch that has the given ID.
     *
     * @param  string  $batchId
     * @return void
     */
    public function cancel(string $batchId)
    {
        //
    }
    /**
     * Delete the batch that has the given ID.
     *
     * @param  string  $batchId
     * @return void
     */
    public function delete(string $batchId)
    {
        //
    }
    /**
     * Execute the given Closure within a storage specific transaction.
     *
     * @param  \Closure  $callback
     * @return mixed
     */
    public function transaction(\Closure $callback)
    {
        return $callback();
    }
}