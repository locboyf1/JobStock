<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\JobRequest;
use App\Models\JobCompany;
use App\Models\JobGroup;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {

        $jobGroup = JobGroup::find($id);
        if (! $jobGroup) {
            return redirect()->route('admin.jobgroup.index')->with('error', 'Nhóm ngành không tồn tại');
        }
        $jobs = $jobGroup->jobs()->orderBy('position')->get();

        return view('admin.job.index', [
            'jobs' => $jobs,
            'jobGroup' => $jobGroup,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $jobGroup = JobGroup::find($id);
        if (! $jobGroup) {
            return redirect()->route('admin.jobgroup.index')->with('error', 'Nhóm ngành không tồn tại');
        }

        return view('admin.job.create', [
            'jobGroup' => $jobGroup,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobRequest $request, string $id)
    {
        $jobGroup = JobGroup::find($id);
        if (! $jobGroup) {
            return redirect()->route('admin.jobgroup.index')->with('error', 'Nhóm ngành không tồn tại');
        }

        $validated = $request->validated();
        $number = $jobGroup->jobs()->max('position');
        $jobGroup->jobs()->create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'is_show' => $request->input('is_show') ? 1 : 0,
            'position' => $number + 1,
        ]);

        return redirect()->route('admin.job.index', $id)->with('success', 'Đã thêm công việc');
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
        $job = JobCompany::find($id);
        if (! $job) {
            return redirect()->route('admin.jobgroup.index')->with('error', 'Công việc không tồn tại');
        }

        return view('admin.job.edit', [
            'job' => $job,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobRequest $request, string $id)
    {
        $validated = $request->validated();
        $job = JobCompany::find($id);
        if (! $job) {
            return redirect()->route('admin.jobgroup.index')->with('error', 'Công việc không tồn tại');
        }

        $job->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'is_show' => $request->input('is_show') ? 1 : 0,
        ]);

        return redirect()->route('admin.job.index', $job->job_group_id)->with('success', 'Công việc đã được cập nhật');
    }

    public function status(string $id)
    {
        $job = JobCompany::find($id);
        if (! $job) {
            return redirect()->route('admin.jobgroup.index')->with('error', 'Công việc không tồn tại');
        }

        $job->update([
            'is_show' => $job->is_show ? 0 : 1,
        ]);

        return redirect()->route('admin.job.index', $job->job_group_id)->with('success', 'Công việc đã được thay đổi trạng thái');
    }

    public function up(string $id)
    {
        $upJob = JobCompany::find($id);
        if (! $upJob) {
            return redirect()->route('admin.jobgroup.index')->with('error', 'Công việc không tồn tại');
        }

        if ($upJob->position != 1) {
            $downJob = JobCompany::where('job_group_id', $upJob->job_group_id)->where('position', $upJob->position - 1)->first();

            $upJob->update([
                'position' => $downJob->position,
            ]);

            $downJob->update([
                'position' => $downJob->position + 1,
            ]);
        }

        return redirect()->route('admin.job.index', ['id' => $upJob->job_group_id])->with('success', 'Công việc đã được di chuyển');
    }

    public function down(string $id)
    {
        $downJob = JobCompany::find($id);
        if (! $downJob) {
            return redirect()->route('admin.jobgroup.index')->with('error', 'Công việc không tồn tại');
        }

        if ($downJob->position != JobCompany::where('job_group_id', $downJob->job_group_id)->max('position')) {
            $upJob = JobCompany::where('job_group_id', $downJob->job_group_id)->where('position', $downJob->position + 1)->first();

            $downJob->update([
                'position' => $upJob->position,
            ]);

            $upJob->update([
                'position' => $upJob->position - 1,
            ]);
        }

        return redirect()->route('admin.job.index', ['id' => $downJob->job_group_id])->with('success', 'Công việc đã được di chuyển');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
