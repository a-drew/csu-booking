<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RoleControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function admins_can_see_roles()
    {
        $role = Role::factory()->create();
        $user = User::factory()->make();

        $this->assertDatabaseHas('roles', $role->toArray());

        $response = $this->actingAs($user)->get('/roles');

        $response->assertOk();
        $response->assertSee($role->name);
    }

    /**
     * @test
     */
    public function admins_can_see_roles_create_form()
    {
        $role = Role::factory()->create();
        $user = User::factory()->make();

        $this->assertDatabaseHas('roles', $role->toArray());

        $response = $this->actingAs($user)->get('/roles/create');

        $response->assertOk();
        $response->assertDontSee($role->name);
        $response->assertSee("create");
    }

    /**
     * @test
     */
    public function admins_can_create_roles()
    {
        $role = Role::factory()->make();
        $user = User::factory()->make();

        $this->assertDatabaseMissing('roles', $role->toArray());

        $response = $this->actingAs($user)->post('/roles', ['name' => $role->name]);

        $response->assertOk();
        $this->assertDatabaseHas('roles', $role->toArray());
    }

    /**
     * @test
     */
    public function admins_can_delete_roles()
    {
        $role = Role::factory()->create();
        $user = User::factory()->make();

        $this->assertDatabaseHas('roles', $role->toArray());

        $response = $this->actingAs($user)->delete('/roles/' . $role->id);

        $response->assertStatus(302);
        $this->assertDatabaseMissing('roles', $role->toArray());
    }
}
