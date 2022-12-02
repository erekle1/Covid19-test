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
    private $baseUrl = "https://devtest.ge/";

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
        $response = Http::post($this->baseUrl . 'get-country-statistics');
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
