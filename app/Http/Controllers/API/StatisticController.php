<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Statistic;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{

    public function summary()
    {
        $results = Statistic::select(
            DB::raw("SUM(death) as death"),
            DB::raw("SUM(confirmed) as confirmed"),
            DB::raw("SUM(recovered) as recovered")
        )->first();

        return response()->json($results);
    }

}
