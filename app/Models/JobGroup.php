<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobGroup extends Model
{
    protected $fillable = [
        'title',
        'description',
        'position',
        'is_show',
    ];

    public function jobs()
    {
        return $this->hasMany(JobCompany::class);
    }
}
