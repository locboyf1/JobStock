<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostReport extends Model
{
    protected $fillable = [
        'job_post_id',
        'name',
        'title',
        'email',
        'content',
        'is_confirmed',
    ];

    public function jobPost()
    {
        return $this->belongsTo(JobPost::class);
    }
}
