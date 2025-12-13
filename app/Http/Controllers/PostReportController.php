<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostReportRequest;
use App\Models\JobPost;
use App\Models\PostReport;

class PostReportController extends Controller
{
    public function store(PostReportRequest $request, string $id)
    {
        $validated = $request->validated();
        $post = JobPost::find($id);
        if (! $post) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
        PostReport::create([
            'job_post_id' => $post->id,
            'name' => $validated['name'],
            'title' => $validated['title'],
            'email' => $validated['email'],
            'content' => $validated['content'],
        ]);

        return redirect()->back()->with('success', 'Bài đăng đã được báo cáo thành công');
    }
}
