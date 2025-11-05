<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBlogCategoryRequest;
use App\Models\BlogCategory;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $categories = BlogCategory::orderBy('position')->get();
        return view('admin.blogcategory.index',[
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blogcategory.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogCategoryRequest $request)
    {
        $validated = $request->validated();
        $number = BlogCategory::count();

        BlogCategory::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'is_show' => $request->input('is_show') ? 1 : 0,
            'position' => $number + 1,
            'alias' => Str::slug($validated['title']) . '-' . time()
        ]);
        return redirect()->route('admin.blogcategory.index');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
