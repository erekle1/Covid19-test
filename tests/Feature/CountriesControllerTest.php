<?php

namespace Tests\Feature;

use App\Models\Country;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CountriesControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_read_countries()
    {
        Sanctum::actingAs(User::factory()->create(),
            ['view-countries']
        );
        $response = $this->get('/api/countries');
        $response->assertStatus(200);
    }

    public function test_get_stats_by_country_code()
    {
        Sanctum::actingAs(User::factory()->create(),
            ['view-countries']
        );
        $country = Country::factory()->create();
        $endpoint = '/api/get-stats/' . $country->code;

        $response = $this->get($endpoint);
        $response->assertJsonCount(1);

        $response->assertStatus(200);
    }
}
