<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Menu;
use App\Models\role as Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RolePermissionControllerTest extends TestCase
{
    use RefreshDatabase;

    private $adminUser;
    private $adminRole;
    private $testRole;
    private $testUser;
    private $menu;

    protected function setUp(): void
    {
        parent::setUp();

        // Create Admin role and admin user
        $this->adminRole = Role::firstOrCreate(['role_name' => 'Admin'], ['is_active' => 'active']);
        $this->adminUser = User::factory()->create([
            'role_id' => $this->adminRole->id,
            'username' => 'admin_test',
        ]);

        // Create standard test role and user
        $this->testRole = Role::create([
            'role_name' => 'Standard Role',
            'is_active' => 'active',
        ]);
        $this->testUser = User::factory()->create([
            'role_id' => $this->testRole->id,
            'username' => 'standard_test',
        ]);

        // Create a test menu
        $this->menu = Menu::create([
            'name' => 'User Management',
            'icon' => 'bi bi-person',
            'route' => 'user.index',
            'parent_id' => null,
            'order' => 1,
            'is_active' => 1,
        ]);

        // Associate all menus with Admin role so admin user passes CheckMenuPermission
        $this->adminRole->menus()->attach($this->menu->id);
    }

    public function test_guest_cannot_access_role_permission()
    {
        $response = $this->get('/role-permission');
        $response->assertRedirect('/signin');
    }

    public function test_admin_can_access_role_permission_index()
    {
        $response = $this->actingAs($this->adminUser)->get('/role-permission');
        $response->assertStatus(200);
        $response->assertViewHas('roles');
        $response->assertViewHas('selectedRole');
        $response->assertViewHas('menus');
        $response->assertViewHas('assignedMenuIds');
    }

    public function test_admin_can_update_role_permissions()
    {
        $postData = [
            'role_id' => $this->testRole->id,
            'menu_ids' => [$this->menu->id],
        ];

        $response = $this->actingAs($this->adminUser)->post('/role-permission', $postData);
        $response->assertRedirect('/role-permission?role_id=' . $this->testRole->id);
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('role_menu', [
            'role_id' => $this->testRole->id,
            'menu_id' => $this->menu->id,
        ]);
    }

    public function test_middleware_restricts_access_to_unpermitted_menu_routes()
    {
        // Standard user does not have access to 'user.index' (User Management menu) yet
        $response = $this->actingAs($this->testUser)->get('/user');
        $response->assertStatus(403);

        // Now grant access to standard user role
        $this->testRole->menus()->attach($this->menu->id);

        // Standard user should now be able to access 'user.index'
        $response = $this->actingAs($this->testUser)->get('/user');
        $response->assertStatus(200);
    }
}
