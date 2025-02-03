<?php

namespace Tests\Unit\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Тест успешной регистрации
     */
    public function test_successful_registration()
    {
        $response = $this->postJson('/api/register', [
            'email' => 'test@example.com',
            'password' => 'password123',
            'gender' => 'male',
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'token',
                'user' => ['id', 'email', 'gender']
            ]);
    }

    /**
     * Тест ошибки валидации
     */
    public function test_registration_validation_error()
    {
        $response = $this->postJson('/api/register', [
            'email' => 'not-an-email',
            'password' => '123',
            'gender' => 'invalid_gender',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email', 'password', 'gender']);
    }

    /**
     * Тест регистрации с существующим email
     */
    public function test_registration_with_existing_email()
    {
        User::create([
            'email' => 'test@example.com',
            'password'=>123123123
        ]);

        $response = $this->postJson('/api/register', [
            'email' => 'test@example.com',
            'password' => 'password123',
            'gender' => 'male',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }
}
