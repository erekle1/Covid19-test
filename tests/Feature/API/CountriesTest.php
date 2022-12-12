<?php

namespace API;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CountriesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_auth_user_can_read_countries()
    {
        Sanctum::actingAs(User::factory()->create());
        $response = $this->get(route('api.countries'));
        $response->assertJsonStructure([
            'data' => [],
            'meta' => [],
        ]);
        $response->assertStatus(200);
    }
}
