<?php

namespace App\Http\Controllers;

use App\Models\JobCompany;
use App\Models\JobGroup;
use App\Models\JobPost;
use App\Models\JobType;
use App\Services\JobPostService;
use App\Utilities\functions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $jobPostService = new JobPostService;
        $provinces = functions::getListProvince();
        if (! Auth::check()) {

            $vector = Cache::get('job_post_vector'.session()->getId());
            if ($vector !== null) {
                $posts = $jobPostService->getJobPostsSimilar($vector, 8);
            } else {
                $posts = JobPost::isShow()->orderBy('created_at', 'desc')->limit(8)->get();
            }

        } else {

            $vector = $jobPostService->getJobPostAverageSimilarity(Auth::user()->id, 3);
            if ($vector !== null) {
                $posts = $jobPostService->getJobPostsSimilar($vector, 8);
            } else {
                $posts = JobPost::isShow()->orderBy('created_at', 'desc')->limit(8)->get();
            }
        }
        $job_groups = JobGroup::where('is_show', 1)->orderBy('position', 'asc')->get();
        $job_types = JobType::where('is_active', 1)->orderBy('position', 'asc')->get();
        $jobs = JobCompany::where('is_show', 1)->orderBy('created_at', 'desc')->get();

        return view('content.home', ['posts' => $posts, 'provinces' => $provinces, 'job_groups' => $job_groups, 'job_types' => $job_types, 'jobs' => $jobs]);
    }
}
