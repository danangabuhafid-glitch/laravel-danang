<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Locker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LockerControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        // Create an admin role first to satisfy foreign key constraint
        $role = \App\Models\role::create([
            'role_name' => 'Admin',
            'is_active' => 'active',
        ]);
        
        // Create an admin user with username and role_id
        $this->user = User::factory()->create([
            'username' => 'testadmin',
            'role_id' => $role->id,
        ]);
    }

    public function test_locker_management_page_is_accessible()
    {
        $response = $this->actingAs($this->user)->get(route('locker.index'));

        $response->assertStatus(200);
        $response->assertSee('Locker Management');
        
        // Verify active class in sidebar is present on the Management Locker menu
        // We look for: <li class="sidebar-item has-sub active"> containing "Management Locker"
        $response->assertSee('sidebar-item has-sub active');
        $response->assertSee('Management Locker');
    }

    public function test_create_locker_successfully()
    {
        $response = $this->actingAs($this->user)->post(route('locker.store'), [
            'locker_code' => 'LK98',
            'locker_name' => 'Test Locker 98',
            'locker_description' => 'Test Locker Description',
            'major' => 'Teknik Jaringan',
            'locker_status' => 'Available',
            'batch' => '2',
        ]);

        $response->assertRedirect(route('locker.index'));
        $response->assertSessionHas('success', 'Locker created successfully!');

        $this->assertDatabaseHas('lockers', [
            'locker_code' => 'LK98',
            'locker_name' => 'Test Locker 98',
            'major' => 'Teknik Jaringan',
            'locker_status' => 'Available',
            'batch' => '2',
        ]);
    }

    public function test_update_locker_successfully()
    {
        $locker = Locker::create([
            'locker_code' => 'LK77',
            'locker_name' => 'Locker Old',
            'locker_description' => 'Old description',
            'major' => 'Multimedia',
            'locker_status' => 'Available',
            'batch' => '1',
        ]);

        $response = $this->actingAs($this->user)->put(route('locker.update', $locker->id), [
            'locker_code' => 'LK77',
            'locker_name' => 'Locker New Name',
            'locker_description' => 'New description',
            'major' => 'Web Programming',
            'locker_status' => 'Unavailable',
            'batch' => '3',
        ]);

        $response->assertRedirect(route('locker.index'));
        $response->assertSessionHas('success', 'Locker updated successfully!');

        $this->assertDatabaseHas('lockers', [
            'id' => $locker->id,
            'locker_code' => 'LK77',
            'locker_name' => 'Locker New Name',
            'major' => 'Web Programming',
            'locker_status' => 'Unavailable',
            'batch' => '3',
        ]);
    }

    public function test_user_management_page_shows_active_sidebar()
    {
        $response = $this->actingAs($this->user)->get(route('user.index'));
        $response->assertStatus(200);
        
        // Data Master menu should be active
        $response->assertSee('sidebar-item has-sub active');
        $response->assertSee('Data Master');
    }

    public function test_role_management_page_shows_active_sidebar()
    {
        $response = $this->actingAs($this->user)->get(route('role.index'));
        $response->assertStatus(200);
        
        // Data Master menu should be active
        $response->assertSee('sidebar-item has-sub active');
        $response->assertSee('Data Master');
    }
}
