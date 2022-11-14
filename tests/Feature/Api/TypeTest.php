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
     * @param string $parameters
     * @dataProvider Tests\Datasets\MockTypeStrings::getRoutes
     */
    public function testCannotAccessProtectedGetRoutesUnauthorized(string ...$parameters): void
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

    /**
     * @param string $parameters
     * @dataProvider Tests\Datasets\MockTypeStrings::putRoutes
     */
    public function testCannotAccessProtectedPutRoutesUnauthorized(string ...$parameters): void
    {
        $response = $this->putJson(route(...$parameters));
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

    public function testCanUpdateANameOfAType(): void
    {
        $userId = User::factory()->create()->id;
        auth()->loginUsingId($userId);

        $type = Type::factory()->create(['user_id' => $userId]);

        $newName = 'radio';

        $response = $this->putJson(route(name: 'api.types.update', parameters: $type->identification), data: ['name' => $newName]);

        $jsonResponse = json_decode($response->content(), true);

        $response->assertStatus(Response::HTTP_OK);
        self::assertEquals($newName, data_get($jsonResponse, 'attributes.name'));
    }

    public function testCannotUpdateATypeNameWithInvalidUuid(): void
    {
        $userId = User::factory()->create()->id;
        auth()->loginUsingId($userId);

        $response = $this->putJson(route(name: 'api.types.update', parameters: 'invalid-uuid'), data: ['name' => 'new-invalid-name']);

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function testCannotUpdateATypeNameThatAlreadyExists(): void
    {
        $userId = User::factory()->create()->id;
        auth()->loginUsingId($userId);

        $name = 'checkbox';

        $type = Type::factory()->create(['name' => 'radio', 'user_id' => $userId]);
        Type::factory()->create(['name' => $name, 'user_id' => $userId]);

        $response = $this->putJson(route(name: 'api.types.update', parameters: $type->identification), ['name' => $name]);

        $jsonResponse = json_decode($response->content(), true);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        self::assertSame("The new name '{$name}' is already taken", data_get($jsonResponse, 'message'));
    }

}