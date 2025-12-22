<?php

namespace App\Http\Controllers;

use App\Models\JobCompany;
use App\Models\JobGroup;
use App\Models\JobPost;
use App\Models\JobType;
use App\Models\ViewJobPostHistory;
use App\Services\JobPostService;
use App\Utilities\functions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $posts = JobPost::query()->isShow();

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;

            $posts->where(function ($query) use ($keyword) {

                $query->where('title', 'like', '%'.$keyword.'%')
                    ->orWhere('description', 'like', '%'.$keyword.'%')
                    ->orWhere(function ($q) use ($keyword) {
                        $q->whereHas('company', function ($q1) use ($keyword) {
                            $q1->where('title', 'like', '%'.$keyword.'%')
                                ->orWhere('description', 'like', '%'.$keyword.'%');
                        });
                    })
                    ->orWhereHas('tags', function ($q2) use ($keyword) {
                        $q2->where('slug', 'like', '%'.Str::slug($keyword).'%')
                            ->orWhere('name', 'like', '%'.$keyword.'%');
                    });
            });
        }

        if ($request->filled('job_id')) {
            $job_id = $request->job_id;
            $posts->where('job_company_id', $job_id);
        } elseif ($request->filled('job_group_id')) {
            $job_group_id = $request->job_group_id;
            $posts->whereHas('jobCompany', function ($q) use ($job_group_id) {
                $q->where('job_group_id', $job_group_id);
            });
        }

        if ($request->filled('province_id')) {
            $province_id = $request->province_id;
            $posts->whereHas('company', function ($q) use ($province_id) {
                $q->orWhere('province_id', $province_id);
            });
        }

        if ($request->filled('job_type_id')) {
            $job_type_id = $request->job_type_id;
            $posts->where('job_type_id', $job_type_id);
        }

        $posts = $posts->orderBy('created_at', 'desc')->paginate(6)->withQueryString();

        $provinces = functions::getListProvince();
        $job_groups = JobGroup::where('is_show', 1)->orderBy('position', 'asc')->get();
        $job_types = JobType::where('is_active', 1)->orderBy('position', 'asc')->get();
        $jobs = JobCompany::where('is_show', 1)->orderBy('position', 'asc')->get();

        return view('content.job.index', ['posts' => $posts, 'provinces' => $provinces, 'job_groups' => $job_groups, 'job_types' => $job_types, 'jobs' => $jobs, 'province_id' => $request->province_id, 'job_id' => $request->job_id, 'job_group_id' => $request->job_group_id, 'job_type_id' => $request->job_type_id, 'keyword' => $request->keyword]);
    }

    public function show(string $id, JobPostService $jobPostService)
    {
        $post = JobPost::find($id);
        if (! $post->is_show || $post == null) {
            return redirect()->route('job.index')->with('error', 'Tin tuyển dụng không tồn tại hoặc đã bị ẩn');
        }

        if (Auth::check()) {
            $user = Auth::user();
            ViewJobPostHistory::create([
                'user_id' => $user->id,
                'job_post_id' => $post->id,
            ]);
        } else {

            $vector = Cache::get('job_post_vector'.session()->getId());
            if ($vector !== null) {
                for ($i = 0; $i < count($post->vector); $i++) {
                    $vector[$i] = 0.8 * $vector[$i] + 0.2 * $post->vector[$i];
                }
                Cache::put('job_post_vector'.session()->getId(), $vector, now()->addDays(7));
            } else {
                Cache::put('job_post_vector'.session()->getId(), $post->vector, now()->addDays(7));
            }
        }
        $postSimilars = $jobPostService->getJobPostsSimilar($post->vector, 4, $post->id);

        return view('content.job.show', ['post' => $post, 'postSimilars' => $postSimilars]);
    }
}
