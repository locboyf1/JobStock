<?php

namespace App\Models;

use App\Utilities\functions;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'tax_code',
        'confirm_image',
        'confirm_updated_image',
        'is_confirmed',
        'is_show',
        'phone',
        'email',
        'users_id',
        'title',
        'logo',
        'website',
        'province_id',
        'address',
        'description',
        'content',
        'facebook',
        'pinterest',
        'youtube',
        'wikipedia',
        'linkedin',
        'shop',
    ];

    public function getIsConfirmedAttribute($value)
    {
        if ($value === null) {
            return null;
        }

        return $value && $this->user->is_active;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function jobs()
    {
        return $this->hasMany(JobPost::class);
    }

    protected $casts = [
        'content' => 'array',
        'is_confirmed' => 'boolean',
        'is_show' => 'boolean',
    ];

    public function favorites()
    {
        return $this->hasMany(CompanyFavorite::class);
    }

    public function getProvinceNameAttribute()
    {
        return functions::getProvinceName($this->province_id);
    }
}
