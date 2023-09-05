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
    public function test_roles(): void
    {
        $response = $this->get('/admin/roles');

        $response->assertStatus(200);
    }
}
