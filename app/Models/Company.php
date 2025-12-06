<?php

namespace App\Models;

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
        'shop'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }


    protected $casts = [
        'content' => 'array'
    ];
}
