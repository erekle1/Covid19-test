<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Services\DevTestAPIService;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(DevTestAPIService $service)
    {
        //check if countries table is populating from countries API
        if (Country::count() == 0) {
            $countries = $service->getCountries();
            foreach ($countries as $country) {
                Country::create([
                    'code' => $country['code'],
                    'name' => json_encode($country['name'])
                ]);
            }
        }
    }
}
