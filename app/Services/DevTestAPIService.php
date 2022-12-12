<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * This service class provides the information from the external API
 */
class DevTestAPIService
{
    private $baseUrl;

    public function __construct($config)
    {
        $this->baseUrl = $config()->get('devtestapi')['base_url'];

    }

    /**
     * get countries data from the external api
     * @return array|int|mixed
     */
    public function getCountries()
    {
        $response = Http::get($this->baseUrl . 'countries');
        if ($response->successful()) {
            return $response->json();
        }
        return $this->catchResponse($response);
    }


    /**
     * get statistics by country code from the external api
     * @param string $countryCode
     * @return array|int|mixed
     */
    public function getStatisticByCountry(string $countryCode)
    {
//        dd($this->baseUrl . 'get-country-statistics',$countryCode);
        $response = Http::accept('application/json')->post($this->baseUrl . 'get-country-statistics', [
            'code' => $countryCode
        ]);
        if ($response->successful()) {
            return $response->json();
        }
        return $this->catchResponse($response);
    }

    /**
     * Log unsuccessful request and return -1
     * @param Response $response
     * @return int
     */
    private function catchResponse(Response $response): int
    {
        $response->onError(function ($error) {
            $errMsg = $error->getReasonPhrase() . "-" . $error->getStatusCode() . "-" . get_class();
            Log::error($errMsg);
            return -1;
        });
        return -1;
    }
}
