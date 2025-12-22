<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PostReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PostReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = PostReport::whereNull('is_confirmed')->get();

        return view('admin.postreport.index', ['reports' => $reports]);
    }

    public function approve($id, Request $request)
    {
        $report = PostReport::find($id);
        if (! $report) {
            return redirect()->route('admin.jobpostreport.index')->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }

        if (! $request->has('process')) {
            return redirect()->route('admin.jobpostreport.show', ['id' => $report->id])->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }

        if ($request->process == 'close_job_post') {
            $report->jobPost->update([
                'is_confirmed' => false,
            ]);
            Mail::html('Rất tiếc, bài đăng của bạn cần được xử lý. Với một bản tố cáo được chúng tôi xác nhận là sự thật, bài đăng '.$report->jobPost->title.' của bạn đã được đóng, bạn có thể sửa nội dung để chúng tôi xem xét lại.', function ($message) use ($report) {
                $message->to($report->jobPost->company->user->email)->subject('JobStock - Thông tin tố cáo đã được xử lý');
            });
        } elseif ($request->process == 'lock_user') {
            $report->jobPost->company->user->update([
                'is_active' => false,
            ]);
            Mail::html('Rất tiếc, tài khoản của bạn cần được xử lý. Với một bản tố cáo được chúng tôi xác nhận là sự thật, tài khoản của bạn đã bị khóa', function ($message) use ($report) {
                $message->to($report->jobPost->company->user->email)->subject('JobStock - Thông tin tố cáo đã được xử lý');
            });
        } else {
            return redirect()->route('admin.jobpostreport.show', ['id' => $report->id])->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }

        Mail::html('Xin chào, thông tin tố cáo của bạn đã được xử lý, nếu bạn có thêm thông tin tố cáo, hãy gửi lại cho chúng tôi nhé.<br>Thân mến.', function ($message) use ($report) {
            $message->to($report->email)->subject('JobStock - Thông tin tố cáo đã được xử lý');
        });

        $report->is_confirmed = true;
        $report->save();

        return redirect()->route('admin.jobpostreport.index')->with('success', 'Đã xác nhận thông tin tố cáo');
    }

    public function unapprove($id, Request $request)
    {
        $report = PostReport::findOrFail($id);
        if (! $report) {
            return redirect()->route('admin.jobpostreport.index')->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
        $report->is_confirmed = false;
        $report->save();

        return redirect()->route('admin.jobpostreport.index')->with('success', 'Đã xác nhận thông tin tố cáo');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $report = PostReport::findOrFail($id);
        if (! $report) {
            return redirect()->route('admin.jobpostreport.index')->with('error', 'Không tìm thấy thông tin tố cáo');
        }

        return view('admin.postreport.show', ['report' => $report]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
