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
        'expired_time',
        'is_active',
        'is_confirmed',
        'address',
        'job_type_id',
        'company_id',
        'job_company_id',
        'description',
        'experience',
        'quantity',
        'vector',
        'reason',
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

    public function postReports()
    {
        return $this->hasMany(PostReport::class);
    }

    public function getIsShowAttribute()
    {
        return $this->is_active && $this->is_confirmed && optional($this->company)->is_confirmed;
    }

    public function scopeIsShow($query)
    {
        return $query->where('is_active', true)
            ->where('is_confirmed', true)
            ->whereHas('company', function ($q) {
                $q->where('is_confirmed', true)
                    ->whereHas('user', function ($u) {
                        $u->where('is_active', true);
                    });
            });
    }

    protected $casts = [
        'content' => 'array',
        'created_at' => 'datetime',
        'expired_time' => 'datetime',
        'vector' => 'array',
        'is_active' => 'boolean',
        'is_confirmed' => 'boolean',
    ];
}
