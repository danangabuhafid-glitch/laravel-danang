<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('role_menu', function (Blueprint $table) {
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
            $table->foreignId('menu_id')->constrained('menus')->onDelete('cascade');
            $table->primary(['role_id', 'menu_id']);
        });

        // Insert new "Role Permission" menu item
        $menuId = DB::table('menus')->insertGetId([
            'name' => 'Role Permission',
            'icon' => 'bi bi-shield-lock-fill',
            'route' => 'role-permission.index',
            'parent_id' => null,
            'order' => 5,
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Get all menu IDs (including the newly created one)
        $menus = DB::table('menus')->get();

        // Assign all menus to Admin (role_id: 1) if it exists
        $adminExists = DB::table('roles')->where('id', 1)->exists();
        if ($adminExists) {
            foreach ($menus as $menu) {
                DB::table('role_menu')->insertOrIgnore([
                    'role_id' => 1,
                    'menu_id' => $menu->id,
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Delete the created menu item (it will cascade delete pivot entries due to onDelete('cascade'))
        DB::table('menus')->where('route', 'role-permission.index')->delete();

        Schema::dropIfExists('role_menu');
    }
};
