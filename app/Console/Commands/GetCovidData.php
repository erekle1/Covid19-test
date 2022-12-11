<?php

namespace App\Console\Commands;

use App\Models\Country;
use App\Models\Statistic;
use App\Services\DevTestAPIService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GetCovidData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:covid-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Covid data from the external source';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(DevTestAPIService $service)
    {
        $countries = Country::all();
        foreach ($countries as $country) {
            $result = $service->getStatisticByCountry($country->code);
            $latestStatistic = $country->statistics()->latest()->first();
            if ($result != -1) {
                $lastUpdateDayFromApi = Carbon::parse($result['updated_at'])->day;
                $lastUpdateDayLocal = Carbon::parse($country->updated_at)->day;
                $payload = [
                    'confirmed' => $result['confirmed'],
                    'recovered' => $result['recovered'],
                    'death'     => $result['deaths'],
                ];
                if (empty($latestStatistic) || $lastUpdateDayFromApi != $lastUpdateDayLocal) {
                    $payload['country_id'] = $country->id;
                    Statistic::create($payload);
                }

                if ($lastUpdateDayFromApi == $lastUpdateDayLocal) {
                    $country->update($payload);
                    $country->save();
                }
            }
        }
    }
}
