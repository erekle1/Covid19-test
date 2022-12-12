<?php

namespace API;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class StatisticTest extends TestCase
{
    use RefreshDatabase;

    public function test_auth_user_can_read_countries()
    {
        Sanctum::actingAs(User::factory()->create());
        $response = $this->get(route('api.statistics.summery'));
        $response->assertJsonStructure([
            'death',
            'recovered',
            'confirmed',
        ]);
        $response->assertStatus(200);
    }

}
