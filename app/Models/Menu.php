<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'title',
        'description',
        'url',
        'position',
        'is_show',
    ];

    public function childrenMenus()
    {
        return $this->hasMany(ChildrenMenu::class, 'menu_id');
    }

    protected $casts = [
        'is_show' => 'boolean',
    ];
}
