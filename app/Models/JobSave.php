<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobSave extends Model
{
    protected $fillable = [
        'user_id',
        'job_post_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jobPost()
    {
        return $this->belongsTo(JobPost::class);
    }
}
