<?php

namespace Tests\Feature\Api;

use App\Enums\ValidationError;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanLogin(): void
    {
        $userData = ['name' => 'User', 'email' => 'user@test.com', 'password' => bcrypt("12345678")];

        User::factory()->create($userData);

        $response = $this->postJson(uri: route(name: 'api.login'), data: ['email' => $userData['email'], 'password' => 12345678]);

        $response->assertOk();
        $response->assertSee('token');
        $response->assertSee('uuid');
    }

    public function testUserCannotLoginInvalidEmail(): void
    {
        $response = $this->postJson(uri: route(name: 'api.login'), data: ['email' => 'invalid-email@test.com', 'password' => 12345678]);

        $response->assertUnprocessable()
                ->assertSeeText("The e-mail is not registered.");
    }

    public function testUserCannotLoginInvalidPassword(): void
    {
        $userData = ['name' => 'User', 'email' => 'user@test.com', 'password' => 12345678];

        User::factory()->create($userData);

        $response = $this->postJson(uri: route(name: 'api.login'), data: ['email' => $userData['email'], 'password' => 123456789]);

        $response->assertUnprocessable()
                ->assertSeeText(ValidationError::PASSWORD_INCORRECT->value);
    }

    public function testUserCanRevokeToken(): void
    {
        $userData = ['name' => 'User', 'email' => 'user@test.com', 'password' => bcrypt("12345678")];

        $user = User::factory()->create($userData);

        Sanctum::actingAs($user);

        $response = $this->postJson(uri: route(name: 'api.auth.revoke', parameters: $user->identification), data: ['token' => $user->getAttribute('token')]);

        $response->assertNoContent();
    }

    public function testUserCannotRevokeInvalidToken(): void
    {
        $userData = ['name' => 'User', 'email' => 'user@test.com', 'password' => bcrypt("12345678")];

        $user = User::factory()->create($userData);

        Sanctum::actingAs($user);

        $response = $this->postJson(uri: route(name: 'api.auth.revoke', parameters: $user->identification), data: ['token' => 'invalid-token']);

        $response->assertUnprocessable()
                ->assertSeeText(ValidationError::TOKEN_INVALID->value);
    }

    public function testInvalidUserCannotRevokeToken(): void
    {
        $userData = ['name' => 'User', 'email' => 'user@test.com', 'password' => bcrypt("12345678")];

        $user = User::factory()->create($userData);

        Sanctum::actingAs($user);

        $response = $this->postJson(uri: route(name: 'api.auth.revoke', parameters: 'invalid-token'), data: ['token' => $user->getAttribute('token')]);

        $response->assertNotFound()
                ->assertSeeText(ValidationError::USER_NOT_REGISTERED->value);
    }
}