<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobCompany extends Model
{
    protected $fillable = [
        'title',
        'description',
        'position',
        'is_show',
    ];

    public function job_group()
    {
        return $this->belongsTo(JobGroup::class);
    }
}
