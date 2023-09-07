<?php

namespace Tests\Feature\Roles;

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListRolesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_to_get_all_roles(): void
    {
        Role::factory()->create([
            'name' => 'admin'
        ]);

        $response = $this->get('/api/api/admin/roles');

        // 200 status
        $response->assertStatus(200);
        $response->assertJsonCount(1, 'data');
        // check that it returns an array of roles
        $response->assertJsonFragment(['name' => 'admin']);
    }

    public function test_only_admin_can_get_roles(): void
    {
        $response = $this->get('/api/v1/admin/roles');

        $response->assertStatus(401);
    }
}
