<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Core\Contracts\Page as PageContract;

class Page extends Model implements PageContract {

    protected $fillable = [
        'title',
        'slug',
        'content',
        'published_at',
    ];

}
