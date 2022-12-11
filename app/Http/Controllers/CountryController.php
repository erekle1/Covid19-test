<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Services\DevTestAPIService;
use Illuminate\Http\Request;

class CountryController extends Controller
{

    /**
     * @route /api/countries
     * Returns all countries from DB
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $data = Country::all();
        return response()->json($data);
    }

    /**
     * @param string $country_code
     * @param DevTestAPIService $devTestAPIService
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStatsByCountryCode(string $country_code, DevTestAPIService $devTestAPIService)
    {
        $result = $devTestAPIService->getStatisticByCountry($country_code);

        return response()->json($result);
    }
}
