<?php

namespace FedExVendor\CageA80\FedEx;

use FedExVendor\CageA80\FedEx\Events\HttpClientError;
use FedExVendor\CageA80\FedEx\Events\HttpServerError;
use FedExVendor\CageA80\FedEx\Events\ReceiveHttpRequest;
use FedExVendor\CageA80\FedEx\Events\SendingHttpRequest;
use FedExVendor\CageA80\FedEx\Listeners\HttpClientErrorEventListener;
use FedExVendor\CageA80\FedEx\Listeners\HttpServerErrorEventListener;
use FedExVendor\CageA80\FedEx\Listeners\ReceiveHttpRequestEventListener;
use FedExVendor\CageA80\FedEx\Listeners\SendingHttpRequestEventListener;
use FedExVendor\Illuminate\Support\Arr;
use FedExVendor\Illuminate\Support\Facades\Event;
use FedExVendor\Illuminate\Support\Facades\Log;
class ServiceProvider extends \FedExVendor\Illuminate\Support\ServiceProvider
{
    protected array $listen = [\FedExVendor\CageA80\FedEx\Events\SendingHttpRequest::class => [\FedExVendor\CageA80\FedEx\Listeners\SendingHttpRequestEventListener::class], \FedExVendor\CageA80\FedEx\Events\ReceiveHttpRequest::class => [\FedExVendor\CageA80\FedEx\Listeners\ReceiveHttpRequestEventListener::class], \FedExVendor\CageA80\FedEx\Events\HttpClientError::class => [\FedExVendor\CageA80\FedEx\Listeners\HttpClientErrorEventListener::class], \FedExVendor\CageA80\FedEx\Events\HttpServerError::class => [\FedExVendor\CageA80\FedEx\Listeners\HttpServerErrorEventListener::class]];
    /**
     * Register service provider.
     *
     * @return void
     */
    public function register()
    {
        $config = $this->app['config']->get('fedex-rest');
        \FedExVendor\Illuminate\Support\Arr::set($config, 'providerConfig.verify', \FedExVendor\Illuminate\Support\Arr::get($config, 'verifySSL', \true));
        $this->app->bind('fedex-rest', function () use($config) {
            $config = $this->initEvents($config);
            return new \FedExVendor\CageA80\FedEx\FedEx($config);
        });
        $this->app->bind('fedex-rest-logger', fn() => \FedExVendor\Illuminate\Support\Facades\Log::channel(\FedExVendor\Illuminate\Support\Arr::get($config, 'logChannel', $this->app['config']->get('logging.default'))));
        $this->registerListeners();
    }
    public function boot()
    {
        $configPath = __DIR__ . '/../../config/fedex-rest.php';
        $this->publishes([$configPath => $this->app->configPath('fedex-rest.php')], 'config');
    }
    protected function initEvents(array $config) : array
    {
        $logInfo = \FedExVendor\Illuminate\Support\Arr::get($config, 'log', \false);
        $config['providerConfig'] = \array_merge(\FedExVendor\Illuminate\Support\Arr::get($config, 'providerConfig'), ['onBeforeRequest' => $logInfo ? fn(string $url, array $data, array $headers) => \FedExVendor\Illuminate\Support\Facades\Event::dispatch(new \FedExVendor\CageA80\FedEx\Events\SendingHttpRequest($url, \count($data) ? $data : null, \count($headers) ? $headers : null)) : null, 'onAfterRequest' => $logInfo ? fn(string $url, array $data, array $headers, ?array $response) => \FedExVendor\Illuminate\Support\Facades\Event::dispatch(new \FedExVendor\CageA80\FedEx\Events\ReceiveHttpRequest($url, \count($data) ? $data : null, \count($headers) ? $headers : null, \count($response) ? $response : null)) : null, 'onClientError' => fn(string $message, int $code, string $url, array $request, array $requestHeaders, array $response) => \FedExVendor\Illuminate\Support\Facades\Event::dispatch(new \FedExVendor\CageA80\FedEx\Events\HttpClientError($message, $code, $url, $request, $requestHeaders, $response)), 'onServerError' => fn(string $message, int $code, string $url, array $request, array $requestHeaders) => \FedExVendor\Illuminate\Support\Facades\Event::dispatch(new \FedExVendor\CageA80\FedEx\Events\HttpServerError($message, $code, $url, $request, $requestHeaders))]);
        return $config;
    }
    protected function registerListeners() : self
    {
        foreach ($this->listen as $event => $listeners) {
            foreach (\array_unique($listeners) as $listener) {
                \FedExVendor\Illuminate\Support\Facades\Event::listen($event, $listener);
            }
        }
        return $this;
    }
}
