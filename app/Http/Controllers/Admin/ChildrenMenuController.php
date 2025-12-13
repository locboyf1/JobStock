<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuRequest;
use App\Models\ChildrenMenu;
use App\Models\Menu;

class ChildrenMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $menu = Menu::find($id);
        if (! $menu) {
            return redirect()->route('admin.menu.index')->with('error', 'Nhóm menu không tồn tại');
        }
        $childrenMenus = $menu->childrenMenus()->get();

        return view('admin.childrenmenu.index', ['menus' => $childrenMenus, 'menuGroup' => $menu]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $menu = Menu::find($id);
        if (! $menu) {
            return redirect()->route('admin.menu.index')->with('error', 'Nhóm menu không tồn tại');
        }

        return view('admin.childrenmenu.create', ['menu' => $menu]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuRequest $request, string $id)
    {
        $menu = Menu::find($id);
        if (! $menu) {
            return redirect()->route('admin.menu.index')->with('error', 'Nhóm menu không tồn tại');
        }
        $validated = $request->validated();
        $number = ChildrenMenu::max('position') + 1;
        ChildrenMenu::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'position' => $number,
            'menu_id' => $id,
            'is_show' => $request->input('is_show') ? 1 : 0,
            'url' => $validated['url'],
        ]);

        return redirect()->route('admin.childrenmenu.index', ['id' => $menu->id])->with('success', 'Thêm menu con thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $menu = Menu::find($id);
        if (! $menu) {
            return redirect()->route('admin.menu.index')->with('error', 'Nhóm menu không tồn tại');
        }
        $childrenMenus = $menu->childrenMenus()->get();

        return view('admin.childrenmenu.index', ['menus' => $childrenMenus, 'menuGroup' => $menu]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $childrenMenus = ChildrenMenu::find($id);
        if (! $childrenMenus) {
            return redirect()->route('admin.childrenmenu.index')->with('error', 'Menu con không tồn tại');
        }

        return view('admin.childrenmenu.edit', ['menu' => $childrenMenus]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MenuRequest $request, string $id)
    {
        $childrenMenus = ChildrenMenu::find($id);
        if (! $childrenMenus) {
            return redirect()->route('admin.childrenmenu.index')->with('error', 'Menu con không tồn tại');
        }
        $validated = $request->validated();
        $childrenMenus->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'is_show' => $request->input('is_show') ? 1 : 0,
            'url' => $validated['url'],
        ]);

        return redirect()->route('admin.childrenmenu.index', ['id' => $childrenMenus->menu_id])->with('success', 'Cập nhật menu con thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
