<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'alias',
        'description',
        'content',
        'image',
        'is_show',
        'blog_category_id',
        'user_id',
    ];

    public function blog_category()
    {
        return $this->belongsTo(BlogCategory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Blog_comment::class);
    }

    protected $casts = [
        'is_show' => 'boolean',
    ];
}
