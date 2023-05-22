<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Contracts\Menu as MenuContract;

class Menu extends Model implements MenuContract {

    protected $fillable = [
        'name',
        'slug',
    ];

    public function menuItems() {
        return $this->hasMany(MenuItem::class);
    }

    public function items() {
        return $this->hasMany(MenuItem::class, 'menu_id')->orderBy('order');
    }

}
