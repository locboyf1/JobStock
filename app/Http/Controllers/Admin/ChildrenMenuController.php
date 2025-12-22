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
        $childrenMenus = $menu->childrenMenus()->orderBy('position')->get();

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
        $number = ChildrenMenu::where('menu_id', $id)->max('position') + 1;
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
    public function show(string $id) {}

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

    public function status(string $is)
    {
        $menu = ChildrenMenu::find($is);
        if (! $menu) {
            return redirect()->route('admin.childrenmenu.index')->with('error', 'Menu con không tồn tại');
        }
        $menu->update([
            'is_show' => ! $menu->is_show,
        ]);

        return redirect()->route('admin.childrenmenu.index', ['id' => $menu->menu_id])->with('success', 'Cập nhật menu con thành công');
    }

    public function up(string $id)
    {
        $upMenu = ChildrenMenu::find($id);
        if (! $upMenu) {
            return redirect()->route('admin.menu.index')->with('error', 'Menu không tồn tại');
        }

        if ($upMenu->position != 1) {
            $downMenu = ChildrenMenu::where('position', $upMenu->position - 1)->first();

            $upMenu->update([
                'position' => $downMenu->position,
            ]);

            $downMenu->update([
                'position' => $downMenu->position + 1,
            ]);
        }

        return redirect()->route('admin.childrenmenu.index', ['id' => $upMenu->menu_id])->with('success', 'Thay đổi vị trí menu thành công');
    }

    public function down(string $id)
    {
        $downMenu = ChildrenMenu::find($id);
        if (! $downMenu) {
            return redirect()->route('admin.menu.index')->with('error', 'Menu không tồn tại');
        }

        if ($downMenu->position != ChildrenMenu::where('menu_id', $downMenu->menu_id)->max('position')) {
            $upMenu = ChildrenMenu::where('position', $downMenu->position + 1)->first();

            $downMenu->update([
                'position' => $upMenu->position,
            ]);

            $upMenu->update([
                'position' => $upMenu->position - 1,
            ]);
        }

        return redirect()->route('admin.childrenmenu.index', ['id' => $downMenu->menu_id])->with('success', 'Thay đổi vị trí menu thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
