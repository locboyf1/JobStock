<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::where('is_confirmed', null)->orderBy('updated_at', 'desc')->get();

        return view('admin.company.index', ['companies' => $companies]);
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
        $company = Company::find($id);
        if (! $company) {
            return redirect()->route('admin.company.index')->with('error', 'Không tìm thấy công ty');
        }

        return view('admin.company.show', ['company' => $company]);
    }

    public function approve(string $id)
    {
        $company = Company::find($id);
        if (! $company) {
            return redirect()->route('admin.company.index')->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
        $company->update([
            'is_confirmed' => 1,
        ]);
        Mail::html('Chúc mừng công ty '.$company->title.' của bạn đã được duyệt, hãy mau mau đăng nhập để trải nghiệm tính năng tuyển dụng tuyệt vời trên JobStock nhé.<br>Thân mến.', function ($message) use ($company) {
            $message->to($company->user->email)->subject('JobStock - Xin chúc mừng');
        });

        return redirect()->route('admin.company.index')->with('success', 'Đã duyệt công ty '.$company->title);
    }

    public function unapprove(string $id)
    {
        $company = Company::find($id);
        if (! $company) {
            return redirect()->route('admin.company.index')->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
        $company->update([
            'is_confirmed' => 0,
        ]);
        Mail::html('Chúng tôi rất tiếc vì đã phải từ chối công ty '.$company->title.', hãy thử sửa thông tin lại lần nữa nhé.<br>Xin lỗi vì sự bất tiện này.<br>Thân mến.', function ($message) use ($company) {
            $message->to($company->user->email)->subject('JobStock - Mong quý khách thông cảm');
        });

        return redirect()->route('admin.company.index')->with('success', 'Đã từ chối công ty '.$company->title);
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
