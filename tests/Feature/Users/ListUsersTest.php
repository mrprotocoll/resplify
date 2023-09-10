<?php

namespace Tests\Feature\Users;

use App\Models\Role;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListUsersTest extends TestCase
{
    use RefreshDatabase;
    private User $admin;
    private User $user;

    private String $url = '/api/v1/admin/users';

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->seed(RoleSeeder::class);
        $this->admin = User::factory()->create();
        $this->user = User::factory()->create();
        $this->admin->roles()->attach(Role::where('name', 'admin')->first());
        $this->user->roles()->attach(Role::where('name','!=', 'admin')->first());
    }

    // test that only admin gets all users
    // to test that it returns an array of users
    public function test_to_get_all_users(): void
    {

        $response = $this->actingAs($this->admin)->get($this->url);

        // 200 status
        $response->assertStatus(200);
        $response->assertJsonCount(1, 'data');
        // check that it returns user data
        $response->assertJsonFragment(['name' => $this->user->name]);
    }

    public function test_only_admin_can_get_users(): void
    {

        $response = $this->actingAs($this->user)->get($this->url);

        // 200 status
        $response->assertStatus(403);
    }

    public function test_public_users_cannot_get_users(): void
    {
        $response = $this->getJson($this->url);

        $response->assertStatus(401);
    }
}