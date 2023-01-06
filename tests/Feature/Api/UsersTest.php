<?php

namespace Tests\Feature\Api;

use App\Enums\ValidationNumbers;
use App\Enums\ValidationError;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @dataProvider Tests\Datasets\MockUsersStrings::routes
     */
    public function testUserCannotAccessRouteWithEmptyUserUuid(string $method, string $uri): void
    {
        $userLogged = User::factory()->create();

        Sanctum::actingAs($userLogged);

        $response = $this->json(method: $method, uri: route(name: $uri, parameters: ['']));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
                ->assertSeeText(ValidationError::EMPTY_UUID->value);
    }

    /**
     * @dataProvider Tests\Datasets\MockUsersStrings::routesWithParameters
     */
    public function testUserCannotAccessRouteWithInvalidUserUuid(string $method, string $uri, array $parameters): void
    {
        $userLogged = User::factory()->create();

        Sanctum::actingAs($userLogged);

        $response = $this->json(method: $method, uri: route(name: $uri, parameters: $parameters));

        $response->assertStatus(Response::HTTP_NOT_FOUND)
                ->assertSeeText(ValidationError::UUID_NOT_VALID->value);
    }

    public function testUserCanListUsersWithPaginate(): void
    {
        $total = 100;
        $limit = 15;

        User::factory($total)->create();

        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $response = $this->getJson(uri: route(name: 'api.users.index', parameters: ['page' => 1, 'limit' => $limit]));

        $response->assertOk()
                ->assertJsonCount($limit, 'data');
    }

    public function testUserCanSeeAnotherUserInfo(): void
    {
        $user = User::factory()->create();

        $userLogged = User::factory()->create();

        Sanctum::actingAs($userLogged);

        $response = $this->getJson(uri: route(name: 'api.users.show', parameters: $user->identification));

        $response->assertOk()
                ->assertSimilarJson(
                    [
                        'uuid' => $user->identification,
                        'name' => $user->name,
                        'email' => $user->email,
                    ]
                );
    }

    public function testUserCannotSeeAnotherUserInfoWithInvalidUuid(): void
    {
        $userLogged = User::factory()->create();

        Sanctum::actingAs($userLogged);

        $response = $this->getJson(uri: route(name: 'api.users.show', parameters: 'invalid-uuid'));

        $response->assertNotFound()
                    ->assertSeeText(ValidationError::UUID_NOT_VALID->value);
    }

    public function testUserCanUpdateAnotherUser(): void
    {
        $userLogged = User::factory()->create(['name' => 'User 1', 'email' => 'user@test.com', 'password' => 12345678]);

        Sanctum::actingAs($userLogged);

        $newData = ['name' => 'User 2', 'email' => 'new@test.com', 'password' => 12345678];

        $response = $this->putJson(uri: route(name: 'api.users.update', parameters: $userLogged->identification), data: $newData);

        unset($newData['password']);
        $newData['uuid'] = $userLogged->identification;

        $response->assertOk()
                ->assertSimilarJson($newData);
    }

    public function testUserCannotUpdateAnotherUserWithInvalidName(): void
    {
        $userLogged = User::factory()->create(['name' => 'User 1', 'email' => 'user@test.com', 'password' => 12345678]);

        Sanctum::actingAs($userLogged);

        $userData = ['name' => 'Te', 'email' => 'test@gmail.com', 'password' => 12345678];

        $response = $this->putJson(uri: route(name: 'api.users.update', parameters: $userLogged->identification), data: $userData);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
                ->assertSeeText("The name must have at least " . ValidationNumbers::MIN_LENGTH_NAME->value . " caracteres.");

    }

    public function testUserCannotUpdateAnotherUserWithInvalidPassword(): void
    {
        $userLogged = User::factory()->create(['name' => 'User 1', 'email' => 'user@test.com', 'password' => 12345678]);

        Sanctum::actingAs($userLogged);

        $userData = ['name' => 'Test user', 'email' => 'test@gmail.com', 'password' => 12345];

        $response = $this->putJson(uri: route(name: 'api.users.update', parameters: $userLogged->identification), data: $userData);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
                ->assertSeeText("The password must have at least ". ValidationNumbers::MIN_LENGTH_PASSWORD->value ." caracteres.");
    }

    public function testUserCannotUpdateAnotherUserWithEmailRegistered(): void
    {
        $userLogged = User::factory()->create(['name' => 'User 1', 'email' => 'user@test.com', 'password' => 12345678]);

        Sanctum::actingAs($userLogged);

        $user = User::factory()->create(['name' => 'User 1', 'email' => 'user@gmail.com', 'password' => 12345678]);

        $userData = ['name' => 'User 2', 'email' => 'user@test.com', 'password' => 12345678];

        $response = $this->putJson(uri: route(name: 'api.users.update', parameters: $user->identification), data: $userData);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
                ->assertSeeText(ValidationError::EMAIL_ALREADY_REGISTERED->value);
    }

    public function testUserCanDeleteAnotherUser(): void
    {
        $userLogged = User::factory()->create(['name' => 'User 1', 'email' => 'user@test.com', 'password' => 12345678]);

        Sanctum::actingAs($userLogged);

        $user = User::factory()->create(['name' => 'User 1', 'email' => 'user@gmail.com', 'password' => 12345678]);

        $response = $this->deleteJson(uri: route(name: 'api.users.destroy', parameters: $user->identification));

        $response->assertNoContent();
    }
}