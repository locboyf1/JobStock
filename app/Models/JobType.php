<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobType extends Model
{
    protected $table = 'job_types';

    protected $fillable = [
        'name',
        'description',
        'position',
        'is_active',
    ];

    public function job_post()
    {
        return $this->hasMany(JobPost::class);
    }

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
