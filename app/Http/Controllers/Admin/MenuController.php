<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuRequest;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::orderBy('position')->get();
        return view('admin.menu.index', compact('menus')); 
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
            'is_show' => $request->input('is_show') ? 1 : 0
        ]);

        return redirect()->route('admin.menu.index');
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
        return view('admin.menu.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MenuRequest $request, string $id)
    {   
        $validated = $request->validated();
        $menu = Menu::find($id);
        $menu->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'url' => $validated['url'],
            'is_show' => $request->input('is_show') ? 1 : 0
        ]);

        return redirect()->route('admin.menu.index');
    }

    public function status(string $id)
    {
        $menu = Menu::find($id);
        if (!$menu) {
            return abort(404);
        }

        $menu->update([
            'is_show' => $menu->is_show ? 0 : 1
        ]);

        return redirect()->route('admin.menu.index');
    }

   
    public function up(string $id)
    {
        $upMenu = Menu::find($id);
        if (!$upMenu) {
            return abort(404);
        }

        if ($upMenu->position != 1) {
            $downMenu = Menu::where('position', $upMenu->position - 1)->first();

            $upMenu->update([
                'position' => $downMenu->position
            ]);

            $downMenu->update([
                'position' => $downMenu->position + 1
            ]);
        }

        return redirect()->route('admin.menu.index');
    }

    public function down(string $id)
    {
        $downMenu = Menu::find($id);
        if (!$downMenu) {
            return abort(404);
        }

        if ($downMenu->position != Menu::max('position')) {
            $upMenu = Menu::where('position', $downMenu->position + 1)->first();

            $downMenu->update([
                'position' => $upMenu->position
            ]);

            $upMenu->update([
                'position' => $upMenu->position - 1
            ]);
        }
        return redirect()->route('admin.menu.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
