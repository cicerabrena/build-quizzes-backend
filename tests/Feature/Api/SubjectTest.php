<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class SubjectTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanCreateASubject(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $data = [
            'name' => 'Ressonância Magnética',
            'description' => 'Descrição padrão.',
            'slug' => 'RM'
        ];

        $response = $this->postJson(uri: route(name: 'api.subjects.store'), data: $data);

        $response->assertCreated()
                ->assertSee('uuid');
    }
}