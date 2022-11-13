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

    private const TABLE_NAME = 'types';

    public function testCannotAccessIndexRouteUnauthorized(): void
    {
        $response = $this->getJson(route(name: 'api.types.index'));
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function testCanRetrieveListOfTypesCreatedByAUser(): void
    {
        $qtdTypes = 4;

        $userId = User::factory()->create()->id;
        auth()->loginUsingId($userId);

        Type::factory()->count($qtdTypes)->create(['user_id' => $userId]);

        $response = $this->getJson(route(name: 'api.types.index'));

        $jsonResponse = json_decode($response->content(), true);

        $response->assertStatus(Response::HTTP_OK);

        self::assertIsArray($jsonResponse);
        self::assertCount($qtdTypes, $jsonResponse);
        self::assertContainsEquals('type', $jsonResponse[0], 'type');
    }

    /**
     * @dataProvider nameOfTypes
     */
    public function testCanUserCreateAType(string $name): void
    {
        $userId = User::factory()->create()->id;
        auth()->loginUsingId($userId);

        $data = ['name' => $name];

        $response = $this->postJson(route(name: 'api.types.store'), data: $data);

        $response->assertStatus(Response::HTTP_CREATED);

        self::assertDatabaseCount(self::TABLE_NAME, 1);
        self::assertDatabaseHas(self::TABLE_NAME, $data);
    }

    /**
     * @return array<int, array<int, string>>
     */
    public function nameOfTypes(): array
    {
        return [
            ['radio'],
            ['checkbox']
        ];
    }
}