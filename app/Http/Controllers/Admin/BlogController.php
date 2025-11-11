<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBlogRequest;
use App\Http\Requests\Admin\UpdateBlogRequest;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\BlogCategory;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::orderBy('created_at')->get();
        return view('admin.blog.index', [
            'blogs' => $blogs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = BlogCategory::orderBy('position')->get();
        return view('admin.blog.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {

            $imagePath = $request->file('image')->store('uploads/images', 'public');
        }

        Blog::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'content' => $validated['content'],
            'blog_category_id' => $validated['blog_category_id'],
            'image' => $imagePath ? $imagePath : '',
            'is_show' => $request->input('is_show') ? 1 : 0,
            'alias' => Str::slug($validated['title']) . '-' . time(),
            'user_id' => 1
        ]);
        return redirect()->route('admin.blog.index');
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
        $blog = Blog::find($id);
        if (!$blog) {
            return abort(404);
        };

        $categories = BlogCategory::orderBy('position')->get();

        return view('admin.blog.edit', compact('blog'), [
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, string $id)
    {
        $validated = $request->validated();

        $blog = Blog::find($id);
        if (!$blog) {
            return abort(404);
        }
        $imagePath = $blog->image;

        if ($request->hasFile('image')) {
           Storage::disk('public')->delete($blog->image);
            $imagePath = $request->file('image')->store('uploads/images', 'public');
        }

        $blog->update(
            [
                'title' => $validated['title'],
                'description' => $validated['description'],
                'content' => $validated['content'],
                'image' => $imagePath,
                'blog_category_id' => $validated['blog_category_id'],
                'is_show' => $request->input('is_show') ? 1 : 0,
                'alias' => Str::slug($validated['title']) . '-' . time(),
                'user_id' => $blog->user_id
            ]
        );

        return redirect()->route('admin.blog.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function status(string $id)
    {
        $blog = Blog::find($id);
        if (!$blog) {
            return abort(404);
        }
        $blog->update([
            'is_show' => $blog->is_show ? 0 : 1
        ]);
        return redirect()->route('admin.blog.index');
    }
}
