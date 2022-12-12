<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;
use App\Http\Resources\CountryWithStatsResource;
use App\Models\Country;
use App\Models\Statistic;
use Illuminate\Http\Request;

class CountryController extends Controller
{

    /**
     * @route /api/countries
     * Returns all countries from DB
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        /*
      * check requested parameters to avoid error from db
      */
        $requestOrderBy = $request->query('order_by', 'id');
        $requestDirection = $request->query('order_direction', 'asc');
        $requestPerPage = $request->query('per_page', 15);
        $searchStr = $request->query('search', false);
        $orderBy = in_array($requestOrderBy, Statistic::$sortableFields) ? $requestOrderBy : 'id';
        $orderDirection = in_array($requestDirection, ['asc', 'desc']) ? $requestDirection : 'asc';
        $perPage = (is_numeric($requestPerPage) and $requestPerPage > 0) ? $requestPerPage : 15;


        $countries = Country::with(['statistics' => function ($q) use ($orderBy, $orderDirection, $searchStr) {
            $q->orderBy($orderBy, $orderDirection)
                ->when($searchStr, function ($searchQuery,$searchStr)  {
                    $searchQuery->orWhere('death', 'like', '%' . $searchStr . '%')
                        ->orWhere('confirmed', 'like', '%' . $searchStr . '%')
                        ->orWhere('recovered', 'like', '%' . $searchStr . '%');
                });
        }])->when($searchStr, function ($query,$searchStr) {
            $query->orWhere('name', 'like', '%' . $searchStr . '%');
            $query->orWhere('code', 'like', '%' . $searchStr . '%');
        })->paginate($perPage);;


        return CountryResource::collection($countries);
    }

}
