<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserTest extends TestCase
{
    use WithFaker;

    /**
     * Register a new user.
     * 
     * @return void
     */
    public function test_register_new_user()
    {
        $response = $this->postJson('/api/register', [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'password' => 12345678,
            'password_confirmation' => 12345678,
        ]);

        $response->assertStatus(201);
    }

    /**
     * Register a new user with invalid email.
     * 
     * @return void
     */
    public function test_register_new_user_with_invalid_email()
    {
        $response = $this->postJson('/api/register', [
            'name' => $this->faker->name(),
            'email' => 'invalid-email',
            'password' => 12345678,
            'password_confirmation' => 12345678,
        ]);

        $response->assertStatus(422);
    }

    /**
     * Register a new user with does not match passwords.
     * 
     * @return void
     */
    public function test_register_new_user_with_does_not_match_passwords()
    {
        $response = $this->postJson('/api/register', [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'password' => 12345678,
            'password_confirmation' => 123456789,
        ]);

        $response->assertStatus(422);
    }

    /**
     * Register a new user with already registered email.
     * 
     * @return void
     */
    public function test_register_new_user_with_already_registered_email()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/register', [
            'name' => $this->faker->name(),
            'email' => $user->email,
            'password' => 12345678,
            'password_confirmation' => 12345678,
        ]);

        $response->assertStatus(422);
    }

    /**
     * Login a user.
     * 
     * @return void
     */
    public function test_login_user()
    {
        $user = User::factory()->create([
            'password' => 12345678
        ]);

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 12345678,
        ]);

        $response->assertStatus(200);
    }

    /**
     * Login a user with invalid email.
     * 
     * @return void
     */
    public function test_login_user_with_invalid_email()
    {
        $user = User::factory()->create([
            'password' => 12345678
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'invalid-email',
            'password' => 12345678,
        ]);

        $response->assertStatus(422);
    }

    /**
     * Login a user with invalid password.
     * 
     * @return void
     */
    public function test_login_user_with_invalid_password()
    {
        $user = User::factory()->create([
            'password' => 12345678
        ]);

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 123456789,
        ]);

        $response->assertStatus(422);
    }

    /**
     * Logout a user.
     * 
     * @return void
     */
    public function test_logout_user()
    {
        Sanctum::actingAs(User::factory()->create());

        $response = $this->postJson('/api/logout');

        $response->assertStatus(200);
    }
}
