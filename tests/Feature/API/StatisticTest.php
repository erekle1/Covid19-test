<?php

namespace API;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class StatisticTest extends TestCase
{
    use RefreshDatabase;

    public function test_read_countries()
    {
        Sanctum::actingAs(User::factory()->create());
        $response = $this->get(route('api.statistics'));
        $response->assertJsonStructure([
            'data'  => [],
            'links' => [],
            'meta'  => []
        ]);
        $response->assertStatus(200);
    }

}
