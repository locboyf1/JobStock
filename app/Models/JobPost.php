<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    protected $fillable = [
        'title',
        'request',
        'salary_min',
        'salary_max',
        'content',
        'expiredTime',
        'is_active',
        'is_confirmed',
        'address',
        'job_type_id',
        'company_id',
        'job_company_id',
        'description',
        'experience',
        'quantity',
    ];

    public function jobType()
    {
        return $this->belongsTo(JobType::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function jobCompany()
    {
        return $this->belongsTo(JobCompany::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'job_post_tags');
    }

    protected $casts = [
        'content' => 'array'];
}
