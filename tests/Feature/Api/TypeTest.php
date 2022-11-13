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

    /**
     * @dataProvider Tests\Datasets\MockTypeStrings::getRoutes
     * @param array<mixed> $parameters
     */
    public function testCannotAccessProtectedGetRoutesUnauthorized(array ...$parameters): void
    {
        $response = $this->getJson(route(...$parameters));
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @dataProvider Tests\Datasets\MockTypeStrings::postRoutes
     */
    public function testCannotAccessProtectedPostRoutesUnauthorized(string $route): void
    {
        $response = $this->postJson(route(name: $route));
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
     * @dataProvider Tests\Datasets\MockTypeStrings::nameOfTypes
     */
    public function testCanUserCreateAType(string $name): void
    {
        $userId = User::factory()->create()->id;
        auth()->loginUsingId($userId);

        $data = ['name' => $name];

        $response = $this->postJson(route(name: 'api.types.store'), data: $data);

        $jsonResponse = json_decode($response->content(), true);

        $response->assertStatus(Response::HTTP_CREATED);

        self::assertDatabaseCount(self::TABLE_NAME, 1);
        self::assertDatabaseHas(self::TABLE_NAME, $data);
        self::assertSame($name, data_get($jsonResponse, 'attributes.name'));
    }

    public function testCanRetrieveTypeByUuid(): void
    {
        $userId = User::factory()->create()->id;
        auth()->loginUsingId($userId);

        $type = Type::factory()->create(['user_id' => $userId]);

        $response = $this->getJson(route(name: 'api.types.show', parameters: $type->identification));

        $jsonResponse = json_decode($response->content(), true);

        $response->assertStatus(Response::HTTP_OK);
        self::assertSame($type->name, data_get($jsonResponse, 'name'));
    }

    public function testCannotRetrieveTypeWithInvalidUuid(): void
    {
        $userId = User::factory()->create()->id;
        auth()->loginUsingId($userId);

        $response = $this->getJson(route(name: 'api.types.show', parameters: 'invalid-uuid'));

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

}