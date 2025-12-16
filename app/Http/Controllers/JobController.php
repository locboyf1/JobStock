<?php

namespace App\Http\Controllers;

use App\Models\JobCompany;
use App\Models\JobGroup;
use App\Models\JobPost;
use App\Models\JobType;
use App\Services\JobPostService;
use App\Utilities\functions;
use Illuminate\Http\Request;
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

        $posts = $posts->orderBy('created_at', 'desc')->paginate(9)->withQueryString();

        $provinces = functions::getListProvince();
        $job_groups = JobGroup::where('is_show', 1)->orderBy('position', 'asc')->get();
        $job_types = JobType::where('is_active', 1)->orderBy('position', 'asc')->get();
        $jobs = JobCompany::where('is_show', 1)->orderBy('position', 'asc')->get();

        return view('content.job.index', ['posts' => $posts, 'provinces' => $provinces, 'job_groups' => $job_groups, 'job_types' => $job_types, 'jobs' => $jobs, 'province_id' => $request->province_id, 'job_id' => $request->job_id, 'job_group_id' => $request->job_group_id, 'job_type_id' => $request->job_type_id, 'keyword' => $request->keyword]);
    }

    public function show(string $id, JobPostService $jobPostService)
    {
        $post = JobPost::findOrFail($id);
        if ($post->is_active == 0 || $post == null) {
            return redirect()->back()->with('error', 'Tin tuyển dụng không tồn tại hoặc đã bị ẩn');
        }

        $postSimilar = $jobPostService->getJobPostsSimilar($post->vector, 4, $post->id);

        return view('content.job.show', ['post' => $post, 'postSimilar' => $postSimilar]);
    }
}
