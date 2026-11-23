<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_application_returns_a_successful_response(): void
    {
        Http::preventStrayRequests();
        Http::fake([
            'api.github.com/users/octocat' => Http::response([]),
            'api.github.com/users/octocat/repos*' => Http::response([]),
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
