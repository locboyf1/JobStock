<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $blogs = Blog::query()->where('is_show', 1)->orderBy('created_at', 'desc');
        $categories = BlogCategory::where('is_show', 1)->orderBy('position', 'asc')->get();
        $popularBlogs = Blog::query()->where('is_show', 1)->withCount('comments')->orderBy('comments_count', 'desc')->take(3)->get();

        $category_id = $request->category;
        if ($category_id) {
            $blogs = $blogs->where('blog_category_id', $category_id);
        }

        $keyword = $request->keyword;
        if ($keyword) {
            $blogs = $blogs->where('title', 'like', '%'.$keyword.'%');
        }

        $blogs = $blogs->paginate(3)->withQueryString();

        return view('content.blog.index', ['blogs' => $blogs, 'categories' => $categories, 'category_id' => $category_id, 'keyword' => $keyword, 'popularBlogs' => $popularBlogs]);
    }

    public function show(string $id, string $alias)
    {
        $blog = Blog::find($id);
        $categories = BlogCategory::where('is_show', 1)->orderBy('position', 'asc')->get();

        if (! $blog) {
            return redirect()->route('blog.index')->with('error', 'Bài viết không tồn tại');
        }

        $popularBlogs = Blog::query()->where('is_show', 1)->withCount('comments')->orderBy('comments_count', 'desc')->take(3)->get();
        $similarBlogs = Blog::query()->where('is_show', 1)->where('blog_category_id', $blog->blog_category_id)->where('id', '!=', $blog->id)->orderBy('created_at', 'desc')->take(3)->get();

        return view('content.blog.show', ['blog' => $blog, 'categories' => $categories, 'popularBlogs' => $popularBlogs, 'similarBlogs' => $similarBlogs]);
    }
}
