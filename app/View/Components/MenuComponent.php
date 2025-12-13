<?php

namespace App\View\Components;

use App\Models\Menu;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MenuComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public $menus;

    public function __construct()
    {
        $this->menus = Menu::where('is_show', 1)->orderBy('position', 'asc')->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.menu-component');
    }
}
