<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Menu;
use App\Models\role as Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MenuControllerTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Create user with a role to authenticate
        $role = Role::firstOrCreate(['role_name' => 'Admin'], ['is_active' => 'active']);
        $this->user = User::factory()->create([
            'role_id' => $role->id,
        ]);
    }

    public function test_guest_redirected_to_login()
    {
        $response = $this->get('/menu');
        $response->assertRedirect('/signin');
    }

    public function test_authenticated_user_can_access_menu_index()
    {
        $response = $this->actingAs($this->user)->get('/menu');
        $response->assertStatus(200);
        $response->assertViewHas('menus');
        $response->assertViewHas('parentMenus');
    }

    public function test_can_create_menu()
    {
        $menuData = [
            'name' => 'Test Menu Item',
            'icon' => 'bi bi-star',
            'route' => 'dashboard',
            'parent_id' => null,
            'order' => 5,
            'is_active' => 1,
        ];

        $response = $this->actingAs($this->user)->post('/menu', $menuData);
        $response->assertRedirect('/menu');
        $response->assertSessionHas('success', 'Menu created successfully!');

        $this->assertDatabaseHas('menus', [
            'name' => 'Test Menu Item',
            'icon' => 'bi bi-star',
            'route' => 'dashboard',
            'order' => 5,
            'is_active' => 1,
        ]);
    }

    public function test_can_update_menu()
    {
        $menu = Menu::create([
            'name' => 'Old Name',
            'icon' => 'bi bi-trash',
            'route' => 'dashboard',
            'parent_id' => null,
            'order' => 1,
            'is_active' => 1,
        ]);

        $updateData = [
            'name' => 'Updated Name',
            'icon' => 'bi bi-pencil',
            'route' => 'user.index',
            'parent_id' => null,
            'order' => 2,
            'is_active' => 0,
        ];

        $response = $this->actingAs($this->user)->put("/menu/{$menu->id}", $updateData);
        $response->assertRedirect('/menu');
        $response->assertSessionHas('success', 'Menu updated successfully!');

        $this->assertDatabaseHas('menus', [
            'id' => $menu->id,
            'name' => 'Updated Name',
            'icon' => 'bi bi-pencil',
            'route' => 'user.index',
            'order' => 2,
            'is_active' => 0,
        ]);
    }

    public function test_can_delete_menu()
    {
        $menu = Menu::create([
            'name' => 'To Be Deleted',
            'icon' => 'bi bi-trash',
            'route' => null,
            'parent_id' => null,
            'order' => 1,
            'is_active' => 1,
        ]);

        $response = $this->actingAs($this->user)->delete("/menu/{$menu->id}");
        $response->assertRedirect('/menu');
        $response->assertSessionHas('success', 'Menu deleted successfully!');

        $this->assertDatabaseMissing('menus', [
            'id' => $menu->id,
        ]);
    }
}
