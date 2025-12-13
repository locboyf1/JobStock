<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogCategoryRequest;
use App\Models\BlogCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $categories = BlogCategory::orderBy('position')->get();

        return view('admin.blogcategory.index', [
            'categories' => $categories,
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
    public function store(BlogCategoryRequest $request)
    {
        $validated = $request->validated();
        $number = BlogCategory::max('position');

        BlogCategory::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'is_show' => $request->input('is_show') ? 1 : 0,
            'position' => $number + 1,
            'alias' => Str::slug($validated['title']).'-'.time(),
        ]);

        return redirect()->route('admin.blogcategory.index')->with('success', 'Thêm danh mục thành công');
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
        $category = BlogCategory::find($id);
        if (! $category) {
            return redirect()->route('admin.blogcategory.index')->with('error', 'Danh mục không tồn tại');
        }

        return view('admin.blogcategory.edit', compact('category'))->with('success', 'Lưu danh mục thành công');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogCategoryRequest $request, string $id)
    {
        $validated = $request->validated();
        $category = BlogCategory::find($id);

        if (! $category) {
            return redirect()->route('admin.blogcategory.index')->with('error', 'Danh mục không tồn tại');
        }

        $category->update(
            [
                'title' => $validated['title'],
                'description' => $validated['description'],
                'is_show' => $request->input('is_show') ? 1 : 0,
                'alias' => Str::slug($validated['title']).'-'.time(),
            ]
        );

        return redirect()->route('admin.blogcategory.index')->with('success', 'Lưu danh mục thành công');
    }

    public function status(string $id)
    {
        $category = BlogCategory::find($id);
        if (! $category) {
            return abort(404);
        }

        $category->update([
            'is_show' => $category->is_show ? 0 : 1,
        ]);
        if ($category->is_show) {
            return redirect()->route('admin.blogcategory.index')->with('success', 'Đã hiển thị danh mục');
        } else {
            return redirect()->route('admin.blogcategory.index')->with('success', 'Đã tắt hiển thị danh mục');
        }
    }

    public function up(string $id)
    {
        $upCategory = BlogCategory::find($id);
        if (! $upCategory) {
            return redirect()->route('admin.blogcategory.index')->with('error', 'Danh mục không tồn tại');
        }

        if ($upCategory->position != 1) {
            $downCategory = BlogCategory::where('position', $upCategory->position - 1)->first();

            $upCategory->update([
                'position' => $downCategory->position,
            ]);

            $downCategory->update([
                'position' => $downCategory->position + 1,
            ]);
        }

        return redirect()->route('admin.blogcategory.index')->with('success', 'Đã di chuyển danh mục lên');
    }

    public function down(string $id)
    {
        $downCategory = BlogCategory::find($id);
        if (! $downCategory) {
            return redirect()->route('admin.blogcategory.index')->with('error', 'Danh mục không tồn tại');
        }

        if ($downCategory->position != BlogCategory::max('position')) {
            $upCategory = BlogCategory::where('position', $downCategory->position + 1)->first();

            $downCategory->update([
                'position' => $upCategory->position,
            ]);

            $upCategory->update([
                'position' => $upCategory->position - 1,
            ]);
        }

        return redirect()->route('admin.blogcategory.index')->with('success', 'Đã di chuyển danh mục xuống');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
