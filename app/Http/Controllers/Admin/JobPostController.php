<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ReasonRejectJobPostRequest;
use App\Models\JobPost;
use Illuminate\Http\Request;

class JobPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobPosts = JobPost::whereNull('is_confirmed')->orderBy('created_at', 'asc')->get();

        return view('admin.jobpost.index', ['jobPosts' => $jobPosts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jobPost = JobPost::find($id);
        if (! $jobPost) {
            return redirect()->route('admin.jobpost.index')->with('error', 'Bài đăng không tồn tại');
        }

        return view('admin.jobpost.show', ['jobPost' => $jobPost]);
    }

    public function approve(string $id)
    {
        $jobPost = JobPost::find($id);
        if (! $jobPost) {
            return redirect()->route('admin.jobpost.index')->with('error', 'Bài đăng không tồn tại');
        }
        $jobPost->update([
            'is_confirmed' => true,
            'reason' => null,
        ]);

        return redirect()->route('admin.jobpost.index')->with('success', 'Bài đăng đã được duyệt');
    }

    public function unapprove(string $id, ReasonRejectJobPostRequest $request)
    {
        $validated = $request->validated();

        $jobPost = JobPost::find($id);
        if (! $jobPost) {
            return redirect()->route('admin.jobpost.index')->with('error', 'Bài đăng không tồn tại');
        }
        $jobPost->update([
            'is_confirmed' => false,
            'reason' => $validated['reason'],
        ]);

        return redirect()->route('admin.jobpost.index')->with('success', 'Bài đăng đã được từ chối');
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
