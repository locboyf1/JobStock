<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\JobTypeRequest;
use App\Models\JobType;

class JobTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobTypes = JobType::orderBy('position', 'asc')->get();

        return view('admin.jobtype.index', ['jobTypes' => $jobTypes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.jobtype.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobTypeRequest $request)
    {

        $validated = $request->validated();
        $number = JobType::max('position');
        JobType::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'position' => $number + 1,
            'is_active' => $request->input('is_active') ? 1 : 0,
        ]);

        return redirect()->route('admin.jobtype.index')->with('success', 'Thêm loại công việc thành công');
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
        $jobType = JobType::find($id);

        return view('admin.jobtype.edit', ['jobType' => $jobType]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobTypeRequest $request, string $id)
    {
        $validated = $request->validated();
        $jobType = JobType::find($id);
        $jobType->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'is_active' => $request->input('is_active') ? 1 : 0,
        ]);

        return redirect()->route('admin.jobtype.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function up(string $id)
    {
        $upJobType = JobType::find($id);
        if (! $upJobType) {
            return abort(404);
        }

        if ($upJobType->position != 1) {
            $downJobType = JobType::where('position', $upJobType->position - 1)->first();

            $upJobType->update([
                'position' => $downJobType->position,
            ]);

            $downJobType->update([
                'position' => $downJobType->position + 1,
            ]);
        }

        return redirect()->route('admin.jobtype.index');
    }

    public function down(string $id)
    {
        $downJobType = JobType::find($id);
        if (! $downJobType) {
            return abort(404);
        }

        if ($downJobType->position != JobType::max('position')) {
            $upJobType = JobType::where('position', $downJobType->position + 1)->first();

            $downJobType->update([
                'position' => $upJobType->position,
            ]);

            $upJobType->update([
                'position' => $upJobType->position - 1,
            ]);
        }

        return redirect()->route('admin.jobtype.index');
    }

    public function status(string $id)
    {
        $jobType = JobType::find($id);
        if (! $jobType) {
            return abort(404);
        }

        $jobType->update([
            'is_active' => ! $jobType->is_active,
        ]);

        return redirect()->route('admin.jobtype.index');
    }
}
