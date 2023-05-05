<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model {

    protected $fillable = [
        'title',    
        'slug',
        'content',
        'published_at',
    ];

}
