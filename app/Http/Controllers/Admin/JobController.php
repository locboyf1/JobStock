<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\JobRequest;
use App\Models\CompanyJob;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\JobGroup;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {

        $jobGroup = JobGroup::find($id);
        if (!$jobGroup) {
            return abort(404);
        }
        $jobs = $jobGroup->jobs()->orderBy('position')->get();
        return view('admin.job.index', [
            'jobs' => $jobs,
            'jobGroup' => $jobGroup
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $jobGroup = JobGroup::find($id);
        if (!$jobGroup) {
            return abort(404);
        }
        return view('admin.job.create', [
            'jobGroup' => $jobGroup
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobRequest $request, string $id)
    {
        $jobGroup = JobGroup::find($id);
        if (!$jobGroup) {
            return abort(404);
        }

        $validated = $request->validated();
        $number = $jobGroup->jobs()->max('position');
        $jobGroup->jobs()->create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'is_show' => $request->input('is_show') ? 1 : 0,
            'position' => $number + 1
        ]);
        return redirect()->route('admin.job.index', $id);
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
        $job = CompanyJob::find($id);
        if (!$job) {
            return abort(404);
        }
        return view('admin.job.edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobRequest $request, string $id)
    {  
        $validated = $request->validated();
        $job = CompanyJob::find($id);
        if (!$job) {
            return abort(404);
        }

        $job->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'is_show' => $request->input('is_show') ? 1 : 0
        ]);

        return redirect()->route('admin.job.index', $job->job_group_id);
    }

    public function status(string $id)
    {
        $job = CompanyJob::find($id);
        if (!$job) {
            return abort(404);
        }

        $job->update([
            'is_show' => $job->is_show ? 0 : 1
        ]);

        return redirect()->route('admin.job.index', $job->job_group_id);
    }

    public function up(string $id)
    {
        $upJob = CompanyJob::find($id);
        if (!$upJob) {
            return abort(404);
        }

        if ($upJob->position != 1) {
            $downJob = CompanyJob::where('job_group_id', $upJob->job_group_id) ->where('position', $upJob->position - 1)->first();

            $upJob->update([
                'position' => $downJob->position
            ]);

            $downJob->update([
                'position' => $downJob->position + 1
            ]);
        }

        return redirect()->route('admin.job.index', ['id' => $upJob->job_group_id]);
    }

    public function down(string $id)
    {
        $downJob = CompanyJob::find($id);
        if (!$downJob) {
            return abort(404);
        }

        if ($downJob->position != CompanyJob::where('job_group_id', $downJob->job_group_id)->max('position')) {
            $upJob = CompanyJob::where('job_group_id', $downJob->job_group_id)->where('position', $downJob->position + 1)->first();

            $downJob->update([
                'position' => $upJob->position
            ]);

            $upJob->update([
                'position' => $upJob->position - 1
            ]);
        }
        return redirect()->route('admin.job.index', ['id' => $downJob->job_group_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
