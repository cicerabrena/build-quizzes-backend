<?php

namespace Tests\Feature\Api;

use App\Models\Type;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class TypeTest extends TestCase
{
    use RefreshDatabase;

    public function testRetrieveListOfCreatedByAUser()
    {
        $qtdTypes = 4;

        $userId = User::factory()->create()->id;
        auth()->loginUsingId($userId);

        Type::factory()->count($qtdTypes)->create(['user_id' => $userId]);

        $response = $this->get(route(name: 'api.types.index'));

        $jsonResponse = json_decode($response->content(), true);

        $response->assertStatus(Response::HTTP_OK);
        $this->assertIsArray($jsonResponse);
        $this->assertCount($qtdTypes, $jsonResponse);
        $this->assertContainsEquals('type', $jsonResponse[0], 'type');
    }
}