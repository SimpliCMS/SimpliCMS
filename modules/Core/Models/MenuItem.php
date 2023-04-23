<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model {

    protected $fillable = [
        'name',
        'url',
        'is_internal',
        'menu_id',
        'parent_id',
    ];

    public function menu() {
        return $this->belongsTo(Menu::class);
    }

    public function children() {
        return $this->hasMany(MenuItem::class, 'parent_id');
    }

}
