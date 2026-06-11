<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate menus table first
        Menu::truncate();

        // 1. Dashboard
        Menu::create([
            'name' => 'Dashboard',
            'icon' => 'bi bi-grid-fill',
            'route' => 'dashboard',
            'parent_id' => null,
            'order' => 1,
            'is_active' => 1,
        ]);

        // 2. Data Master (Parent)
        $dataMaster = Menu::create([
            'name' => 'Data Master',
            'icon' => 'bi bi-person-badge-fill',
            'route' => null,
            'parent_id' => null,
            'order' => 2,
            'is_active' => 1,
        ]);

        // Submenus of Data Master
        Menu::create([
            'name' => 'User',
            'icon' => null,
            'route' => 'user.index',
            'parent_id' => $dataMaster->id,
            'order' => 1,
            'is_active' => 1,
        ]);

        Menu::create([
            'name' => 'Role',
            'icon' => null,
            'route' => 'role.index',
            'parent_id' => $dataMaster->id,
            'order' => 2,
            'is_active' => 1,
        ]);

        Menu::create([
            'name' => 'Major',
            'icon' => null,
            'route' => 'major.index',
            'parent_id' => $dataMaster->id,
            'order' => 3,
            'is_active' => 1,
        ]);

        Menu::create([
            'name' => 'Key',
            'icon' => null,
            'route' => 'key.index',
            'parent_id' => $dataMaster->id,
            'order' => 4,
            'is_active' => 1,
        ]);

        Menu::create([
            'name' => 'Student',
            'icon' => null,
            'route' => 'student.index',
            'parent_id' => $dataMaster->id,
            'order' => 5,
            'is_active' => 1,
        ]);

        Menu::create([
            'name' => 'Instructor',
            'icon' => null,
            'route' => 'instructor.index',
            'parent_id' => $dataMaster->id,
            'order' => 6,
            'is_active' => 1,
        ]);

        // 3. Management Locker (Parent)
        $lockerManagement = Menu::create([
            'name' => 'Management Locker',
            'icon' => 'bi bi-tools',
            'route' => null,
            'parent_id' => null,
            'order' => 3,
            'is_active' => 1,
        ]);

        // Submenus of Management Locker
        Menu::create([
            'name' => 'Data Locker',
            'icon' => null,
            'route' => 'locker.index',
            'parent_id' => $lockerManagement->id,
            'order' => 1,
            'is_active' => 1,
        ]);

        // 4. Menu Management (Top level)
        Menu::create([
            'name' => 'Menu Management',
            'icon' => 'bi bi-menu-button-wide-fill',
            'route' => 'menu.index',
            'parent_id' => null,
            'order' => 4,
            'is_active' => 1,
        ]);
    }
}
