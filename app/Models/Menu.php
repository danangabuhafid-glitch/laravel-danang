<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'name',
        'icon',
        'route',
        'parent_id',
        'order',
        'is_active',
    ];

    /**
     * Get the submenus for this menu.
     */
    public function submenus()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('order');
    }

    /**
     * Get the parent menu.
     */
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    /**
     * Determine if this menu or any of its submenus is active.
     */
    public function isActive(): bool
    {
        if ($this->route) {
            // Check if it has a resource pattern, e.g., 'user.index'
            if (str_contains($this->route, '.')) {
                $base = explode('.', $this->route)[0];
                if (request()->routeIs($base . '.*')) {
                    return true;
                }
            }
            // Check exact route match
            if (request()->routeIs($this->route)) {
                return true;
            }
        }

        // If it's a parent menu, it is active if any of its submenus is active
        foreach ($this->submenus as $submenu) {
            if ($submenu->isActive()) {
                return true;
            }
        }

        return false;
    }
}
