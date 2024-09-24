<?php

namespace FedExVendor\CageA80\FedEx\Services\Rates;

use FedExVendor\CageA80\FedEx\RateRequestControlParameters;
use FedExVendor\CageA80\FedEx\RequestAbstract;
use FedExVendor\CageA80\FedEx\Shipment;
use FedExVendor\CageA80\FedEx\Support\Endpoint;
use FedExVendor\GuzzleHttp\RequestOptions;
use FedExVendor\Psr\Log\NullLogger;
/**
 * Class Rates
 *
 * $config = [
 *  'environment' => EnvironmentType::SANDBOX | EnvironmentType::PRODUCTION,
 *  'provider' => 'guzzle',
 *  'accountNumber' => string,
 *  'token' => string,
 *  'carrierCodes' => array<CarrierCodeType>
 * ]
 *
 * @package FedEx
 */
class RatesRequest extends \FedExVendor\CageA80\FedEx\RequestAbstract
{
    /**
     * @param Shipment $shipment
     * @param RateRequestControlParameters|null $rateRequestControlParameters
     *
     * @return RatesResponse
     */
    public function getRates(\FedExVendor\CageA80\FedEx\Shipment $shipment, \FedExVendor\CageA80\FedEx\RateRequestControlParameters $rateRequestControlParameters = null) : \FedExVendor\CageA80\FedEx\Services\Rates\RatesResponse
    {
        $requestBody = $this->getRequestBody($shipment, $rateRequestControlParameters);
        $this->logRequest($requestBody);
        return $this->request(function () use($requestBody) {
            $request = $this->getHttpProvider();
            $response = $request->post(\FedExVendor\CageA80\FedEx\Support\Endpoint::RATES, [\FedExVendor\GuzzleHttp\RequestOptions::JSON => $requestBody], ['Authorization' => 'Bearer ' . $this->getApiToken(), 'X-locale' => 'en_US', 'Accept' => 'application/json']);
            $this->logResponse($response);
            return new \FedExVendor\CageA80\FedEx\Services\Rates\RatesResponse($response, $this->config);
        });
    }
    protected function getRequestBody(\FedExVendor\CageA80\FedEx\Shipment $shipment, \FedExVendor\CageA80\FedEx\RateRequestControlParameters $rateRequestControlParameters = null) : array
    {
        $request = ['accountNumber' => ['value' => $this->config['accountNumber']], 'requestedShipment' => $shipment->getData(), 'carrierCodes' => $this->config['carrierCodes'] ?? []];
        if ($rateRequestControlParameters) {
            $request['rateRequestControlParameters'] = $rateRequestControlParameters->getData();
        } else {
            if ((bool) @$this->config['returnTransitTimes']) {
                $request['rateRequestControlParameters'] = ['returnTransitTimes' => $this->config['returnTransitTimes']];
            }
        }
        return $request;
    }
    private function logRequest(array $requestBody)
    {
        $this->getLogger()->info('API request', ['content' => \json_encode($requestBody, \JSON_PRETTY_PRINT), 'env' => $this->config['environment'], 'url' => \FedExVendor\CageA80\FedEx\Support\Endpoint::RATES]);
    }
    private function logResponse(array $response)
    {
        $this->getLogger()->info('API response', ['content' => \json_encode($response, \JSON_PRETTY_PRINT), 'env' => $this->config['environment']]);
    }
    private function getLogger()
    {
        return $this->config['logger'] ?? new \FedExVendor\Psr\Log\NullLogger();
    }
}