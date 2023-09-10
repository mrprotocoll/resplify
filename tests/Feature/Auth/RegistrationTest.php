<?php

namespace Tests\Feature\Auth;

use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_users_can_register(): void
    {
        $this->seed(RoleSeeder::class);
        $response = $this->postJson('/api/v1/user/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertStatus(201);
        // response should include role as a user
        $response->assertJsonFragment(['roles' => ['user']]);
    }

    public function test_new_reviewer_can_register(): void
    {
        $this->seed(RoleSeeder::class);

        $response = $this->postJson('/api/v1/reviewer/register', [
            'name' => 'Test Reviewer',
            'email' => 'reviewer@example.com',
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertStatus(201);
        // response should include role as a reviewer
        $response->assertJsonFragment(['roles' => ['reviewer']]);
    }
}
