<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewJobPostHistory extends Model
{
    protected $table = 'view_job_post_histories';

    protected $fillable = [
        'job_post_id',
        'user_id',
    ];

    public function jobPost()
    {
        return $this->belongsTo(JobPost::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
