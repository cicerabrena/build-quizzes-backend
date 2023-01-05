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
     * @dataProvider Tests\Datasets\MockTypeStrings::routes
     */
    public function testCannotAccessProtectedRoutesUnauthorized(string $method, string $uri, array $parameters = []): void
    {
        $response= $this->json($method, route($uri, $parameters));

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
        self::assertSame($name, data_get($jsonResponse, 'name'));
    }

    public function testUserCannotCreateDuplicateType(): void
    {
        $userId = User::factory()->create()->id;

        auth()->loginUsingId($userId);

        $name = 'radio';

        Type::factory()->create(['user_id' => $userId, 'name' => $name]);

        $response = $this->postJson(route(name: 'api.types.store'), data: ['name' => $name]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
                ->assertSeeText('The name of the type is already taken');
    }

    public function testCanRetrieveTypeByUuid(): void
    {
        $userId = User::factory()->create()->id;

        auth()->loginUsingId($userId);

        $type = Type::factory()->create(['user_id' => $userId]);

        $response = $this->getJson(route(name: 'api.types.show', parameters: $type->identification));

        $response->assertStatus(Response::HTTP_OK)
                ->assertSeeText($type->name);
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

        $response->assertStatus(Response::HTTP_OK)
                ->assertSeeText($newName);
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

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
                ->assertSeeText(value: "The new name '{$name}' is already taken", escape: false);
    }

    public function testCanSoftDeleteAType(): void
    {
        $userId = User::factory()->create()->id;

        auth()->loginUsingId($userId);

        $type = Type::factory()->create(['name' => 'radio', 'user_id' => $userId])->toArray();

        $response = $this->deleteJson(route(name: 'api.types.destroy', parameters:  data_get($type, 'identification')));

        $response->assertStatus(Response::HTTP_OK);
        self::assertDatabaseHas(self::TABLE_NAME, $type);
        self::assertSoftDeleted(self::TABLE_NAME, $type);
    }

    public function testCannotSoftDeleteATypeWithInvalidUuid(): void
    {
        $userId = User::factory()->create()->id;

        auth()->loginUsingId($userId);

        $response = $this->deleteJson(route(name: 'api.types.destroy', parameters: 'invalid-uuid'));

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

}