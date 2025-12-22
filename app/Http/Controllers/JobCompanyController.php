<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Jobs\CensorContentJobPost;
use App\Jobs\EmbeddingJobPost;
use App\Models\JobCompany;
use App\Models\JobGroup;
use App\Models\JobPost;
use App\Models\JobType;
use App\Models\Tag;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class JobCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $company = Auth::user()->company;
        if ($company == null) {
            return redirect()->route('home')->with('info', 'Vui lòng đăng ký công ty trước khi đăng bài tuyển dụng.');
        }
        $jobs = JobPost::where('company_id', $company->id)->orderBy('created_at', 'desc')->get();

        return view('content.jobcompany.index', ['jobs' => $jobs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $job_types = JobType::all();
        $job_groups = JobGroup::where('is_show', true)->get();
        $jobs = JobCompany::where('is_show', true)->get();
        $company = Auth::user()->company;

        return view('content.jobcompany.create', ['company' => $company, 'job_types' => $job_types, 'job_groups' => $job_groups, 'jobs' => $jobs]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobRequest $request)
    {
        $company = Auth::user()->company;
        if ($company == null) {
            return redirect()->route('company.terms');
        }
        $validated = $request->validated();
        $post = JobPost::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'job_type_id' => $validated['job_type_id'],
            'job_company_id' => $validated['job_id'],
            'salary_min' => $validated['salary_min'],
            'salary_max' => $validated['salary_max'],
            'experience' => $validated['experience'],
            'quantity' => $validated['quantity'],
            'content' => $validated['content'],
            'expired_time' => Carbon::createFromFormat('m/d/Y', $validated['expired_time'])->format('Y-m-d'),
            'company_id' => $company->id,
            'is_active' => true,
        ]);

        if ($request->filled('tags')) {
            $tags = explode(',', $request->tags);
            $tagsId = [];
            foreach ($tags as $tag) {
                $tag = trim($tag);
                if (empty($tag)) {
                    continue;
                }
                $slug = Str::slug($tag);
                $tag = Tag::firstOrCreate(
                    ['slug' => $slug],
                    ['name' => $tag]
                );
                $tagsId[] = $tag->id;
            }

            $post->tags()->sync($tagsId);
        }

        CensorContentJobPost::dispatch($post->id);
        EmbeddingJobPost::dispatch($post->id);

        return redirect()->route('company.job.index')->with('success', 'Tin tuyển dụng đã được tạo thành công.');
    }

    public function status(string $id)
    {
        $post = JobPost::find($id);
        if ($post == null) {
            return redirect()->route('company.job.index')->with('error', 'Tin tuyển dụng không tồn tại.');
        }

        $post->update([
            'is_active' => ! $post->is_active,
        ]);

        if ($post->company->is_confirmed != true) {
            return redirect()->route('company.job.index')->with('info', 'Tùy chỉnh sẽ tự động áp dụng ngay khi công ty bạn được chấp nhận.');
        }

        return redirect()->route('company.job.index')->with('success', 'Tin tuyển dụng đã được cập nhật thành công.');
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
        $post = JobPost::find($id);
        if ($post == null) {
            return redirect()->route('company.job.index')->with('error', 'Tin tuyển dụng không tồn tại.');
        }

        $tags = $post->tags->pluck('name')->implode(', ');

        return view('content.jobcompany.edit', ['post' => $post, 'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobRequest $request, string $id)
    {

        $company = Auth::user()->company;
        $post = JobPost::find($id);
        if ($post == null) {
            return redirect()->route('company.job.index')->with('error', 'Tin tuyển dụng không tồn tại.');
        }

        $validated = $request->validated();
        $post->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'salary_min' => $validated['salary_min'],
            'salary_max' => $validated['salary_max'],
            'experience' => $validated['experience'],
            'quantity' => $validated['quantity'],
            'content' => $validated['content'],
            'expired_time' => Carbon::createFromFormat('m/d/Y', $validated['expired_time'])->format('Y-m-d'),
            'company_id' => $company->id,
        ]);

        if ($request->filled('tags')) {
            $tags = explode(',', $request->tags);
            $tagsId = [];
            foreach ($tags as $tag) {
                $tag = trim($tag);
                if (empty($tag)) {
                    continue;
                }
                $slug = Str::slug($tag);
                $tag = Tag::firstOrCreate(
                    ['slug' => $slug],
                    ['name' => $tag]
                );
                $tagsId[] = $tag->id;
            }

            $post->tags()->sync($tagsId);
        }

        CensorContentJobPost::dispatch($post->id);
        EmbeddingJobPost::dispatch($post->id);

        return redirect()->route('company.job.index')->with('success', 'Tin tuyển dụng đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
