<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\JobGroupRequest;
use Illuminate\Http\Request;
use App\Models\JobGroup;

class JobGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobGroups = JobGroup::orderBy('position')->get();
        return view('admin.jobgroup.index', [
            'jobGroups' => $jobGroups
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.jobgroup.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobGroupRequest $request)
    {
        $validated = $request->validated();
        $number = JobGroup::max('position');
        JobGroup::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'is_show' => $request->input('is_show') ? 1 : 0,
            'position' => $number + 1
        ]);
        return redirect()->route('admin.jobgroup.index');
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
        $jobGroup = JobGroup::find($id);
        if (!$jobGroup) {
            return abort(404);
        }
        return view('admin.jobgroup.edit', compact('jobGroup'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobGroupRequest $request, string $id)
    {
        $validated = $request->validated();
        $jobGroup = JobGroup::find($id);
        if (!$jobGroup) {
            return abort(404);
        }

        $jobGroup->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'is_show' => $request->input('is_show') ? 1 : 0
        ]);

        return redirect()->route('admin.jobgroup.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function status(string $id)
    {
        $jobGroup = JobGroup::find($id);
        if (!$jobGroup) {
            return abort(404);
        }

        $jobGroup->update([
            'is_show' => $jobGroup->is_show ? 0 : 1
        ]);

        return redirect()->route('admin.jobgroup.index');
    }

    public function up(string $id)
    {
        $upJobGroup = JobGroup::find($id);
        if (!$upJobGroup) {
            return abort(404);
        }

        if ($upJobGroup->position != 1) {
            $downJobGroup = JobGroup::where('position', $upJobGroup->position - 1)->first();

            $upJobGroup->update([
                'position' => $downJobGroup->position
            ]);

            $downJobGroup->update([
                'position' => $downJobGroup->position + 1
            ]);
        }

        return redirect()->route('admin.jobgroup.index');
    }

    public function down(string $id)
    {
        $downJobGroup = JobGroup::find($id);
        if (!$downJobGroup) {
            return abort(404);
        }

        if ($downJobGroup->position != JobGroup::max('position')) {
            $upJobGroup = JobGroup::where('position', $downJobGroup->position + 1)->first();

            $downJobGroup->update([
                'position' => $upJobGroup->position
            ]);

            $upJobGroup->update([
                'position' => $upJobGroup->position - 1
            ]);
        }
        return redirect()->route('admin.jobgroup.index');
    }
}
