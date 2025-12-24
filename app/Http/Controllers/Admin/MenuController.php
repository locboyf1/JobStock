<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MenuRequest;
use App\Models\Menu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::orderBy('position')->get();

        return view('admin.menu.index', ['menus' => $menus]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuRequest $request)
    {
        $number = Menu::max('position');
        $validated = $request->validated();
        Menu::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'url' => $validated['url'],
            'position' => $number + 1,
            'is_show' => $request->input('is_show') ? 1 : 0,
        ]);

        return redirect()->route('admin.menu.index')->with('success', 'Thêm menu thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $menu = Menu::find($id);
        if (! $menu) {
            return redirect()->route('admin.menu.index')->with('error', 'Menu không tồn tại');
        }

        return view('admin.menu.edit', ['menu' => $menu]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MenuRequest $request, string $id)
    {
        $validated = $request->validated();
        $menu = Menu::find($id);

        if (! $menu) {
            return redirect()->route('admin.menu.index')->with('error', 'Menu không tồn tại');
        }

        $menu->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'url' => $validated['url'],
            'is_show' => $request->input('is_show') ? 1 : 0,
        ]);

        return redirect()->route('admin.menu.index')->with('success', 'Lưu menu thành công');
    }

    public function status(string $id)
    {
        $menu = Menu::find($id);
        if (! $menu) {
            return redirect()->route('admin.menu.index')->with('error', 'Menu không tồn tại');
        }

        $menu->update([
            'is_show' => $menu->is_show ? 0 : 1,
        ]);

        return redirect()->route('admin.menu.index')->with('success', 'Thay đổi trạng thái menu thành công');
    }

    public function up(string $id)
    {
        $upMenu = Menu::find($id);
        if (! $upMenu) {
            return redirect()->route('admin.menu.index')->with('error', 'Menu không tồn tại');
        }

        if ($upMenu->position != 1) {
            $downMenu = Menu::where('position', $upMenu->position - 1)->first();

            $upMenu->update([
                'position' => $downMenu->position,
            ]);

            $downMenu->update([
                'position' => $downMenu->position + 1,
            ]);
        }

        return redirect()->route('admin.menu.index')->with('success', 'Thay đổi vị trí menu thành công');
    }

    public function down(string $id)
    {
        $downMenu = Menu::find($id);
        if (! $downMenu) {
            return redirect()->route('admin.menu.index')->with('error', 'Menu không tồn tại');
        }

        if ($downMenu->position != Menu::max('position')) {
            $upMenu = Menu::where('position', $downMenu->position + 1)->first();

            $downMenu->update([
                'position' => $upMenu->position,
            ]);

            $upMenu->update([
                'position' => $upMenu->position - 1,
            ]);
        }

        return redirect()->route('admin.menu.index')->with('success', 'Thay đổi vị trí menu thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
