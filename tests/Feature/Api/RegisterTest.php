<?php

namespace Tests\Feature\Api;

use App\Enums\ValidationNumbers;
use App\Enums\ValidationError;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    private const TABLE_NAME = 'users';

    public function testCanRegisterUser(): void
    {
        $userData = ['name' => 'Test user', 'email' => 'test@gmail.com', 'password' => 12345678];

        $response = $this->postJson(route(name: 'api.register'), data: $userData);

        $response->assertStatus(Response::HTTP_CREATED);

        unset($userData['password']);

        self::assertDatabaseHas(self::TABLE_NAME, $userData);
        $response->assertSee('token');
        $response->assertSee('uuid');
    }

    public function testCannotRegisterUserWithInvalidName(): void
    {
        $userData = ['name' => 'Te', 'email' => 'test@gmail.com', 'password' => 12345678];

        $response = $this->postJson(route(name: 'api.register'), data: $userData);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
                ->assertSeeText("The name must have at least " . ValidationNumbers::MIN_LENGTH_NAME->value . " caracteres.");
    }

    public function testCannotRegisterUserWithInvalidPassword(): void
    {
        $userData = ['name' => 'Test user', 'email' => 'test@gmail.com', 'password' => 12345];

        $response = $this->postJson(route(name: 'api.register'), data: $userData);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
                ->assertSeeText("The password must have at least ". ValidationNumbers::MIN_LENGTH_PASSWORD->value ." caracteres.");
    }

    public function testCannotRegisterUserWithEmailRegistered(): void
    {
        User::factory()->create(['name' => 'User 1', 'email' => 'user@gmail.com', 'password' => 12345678]);

        $userData = ['name' => 'User 2', 'email' => 'user@gmail.com', 'password' => 12345678];

        $response = $this->postJson(route(name: 'api.register'), data: $userData);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
                ->assertSeeText(ValidationError::EMAIL_ALREADY_REGISTERED->value);
    }

}