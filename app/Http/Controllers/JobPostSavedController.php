<?php

namespace App\Http\Controllers;

use App\Models\JobSave;
use Auth;

class JobPostSavedController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $savedPosts = JobSave::where('user_id', $user->id)->paginate(5)->withQueryString();

        return view('content.postsaved.index', ['savedPosts' => $savedPosts]);
    }

    public function destroy($id)
    {
        $savedPost = JobSave::find($id);
        if (! $savedPost) {
            return redirect()->route('jobpostsaved.index')->with('error', 'Bài đăng không tồn tại');
        }
        $savedPost->delete();

        return redirect()->route('jobpostsaved.index')->with('success', 'Bài đăng đã được xóa khỏi danh sách đã lưu');
    }
}
