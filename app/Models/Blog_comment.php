<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog_comment extends Model
{
    protected $table = 'blog_comments';

    protected $fillable = [
        'blog_id',
        'user_id',
        'content',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
