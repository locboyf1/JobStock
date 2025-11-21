<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;

class ChildrenMenu extends Model
{
    protected $fillable = [
        'title',
        'description',
        'url',
        'position',
        'is_show',
        'menu_id'
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}

