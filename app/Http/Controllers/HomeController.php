<?php

namespace App\Http\Controllers;

use App\Models\JobCompany;
use App\Models\JobGroup;
use App\Models\JobPost;
use App\Models\JobType;
use App\Utilities\functions;

class HomeController extends Controller
{
    public function index()
    {
        $provinces = functions::getListProvince();
        $posts = JobPost::where('is_active', 1)->orderBy('created_at', 'desc')->paginate(10);
        $job_groups = JobGroup::where('is_show', 1)->orderBy('position', 'asc')->get();
        $job_types = JobType::where('is_active', 1)->orderBy('position', 'asc')->get();
        $jobs = JobCompany::where('is_show', 1)->orderBy('created_at', 'desc')->get();

        return view('content.home', ['posts' => $posts, 'provinces' => $provinces, 'job_groups' => $job_groups, 'job_types' => $job_types, 'jobs' => $jobs]);
    }
}
