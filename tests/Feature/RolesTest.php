<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RolesTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_to_get_all_roles(): void
    {
        $response = $this->get('/admin/roles');

        // 200 status
        // cannot be accessible by other users except admin
        $response->assertStatus(200);
    }

    public function test_to_create_new_role(): void
    {
        $response = $this->post('/admin/roles');

        // 201 status
        // cannot be created by other users except admin
        $response->assertStatus(200);
    }

    public function test_to_update_a_role(): void
    {
        $id =
        $response = $this->put('/admin/roles/'. $id);

        // 200 status
        // role cannot be updated by other users except admin
        $response->assertStatus(200);
    }
}
