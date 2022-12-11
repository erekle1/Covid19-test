<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\StatisticResource;
use App\Models\Statistic;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
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
        /*
         * get statistic data from DB according to the requested parameters
         */
        $statistics = Statistic::orderBy($orderBy, $orderDirection)
            ->when($searchStr, function ($query, $searchStr) {
                $query->orWhere('death', 'like', '%' . $searchStr . '%')
                    ->orWhere('confirmed', 'like', '%' . $searchStr . '%')
                    ->orWhere('recovered', 'like', '%' . $searchStr . '%')
                    ->orWhereHas('country', function ($q) use ($searchStr) {
                        $q->where('name', 'like', '%' . $searchStr . '%');
                    });
            })
            ->paginate($perPage);
        $statistics->appends(['order_by' => $orderBy, 'order_direction' => $orderDirection]);
        return StatisticResource::collection($statistics);
    }

}
