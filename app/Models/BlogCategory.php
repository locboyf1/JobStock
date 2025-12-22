<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $fillable = [
        'title',
        'description',
        'position',
        'alias',
        'is_show',
    ];

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    protected $casts = [
        'is_show' => 'boolean',
    ];
}
