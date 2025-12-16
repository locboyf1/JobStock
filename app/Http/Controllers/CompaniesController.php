<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Utilities\functions;

class CompaniesController extends Controller
{
    public function index()
    {
        return view('content.companies.index');
    }

    public function show(string $id)
    {
        $company = Company::find($id);
        if (! $company || ! $company->is_confirmed) {
            return redirect()->route('companies.index')->with('error', 'Công ty không tồn tại');
        }

        $provinceName = functions::getProvinceName($company->province_id);

        $posts = $company->jobs()->isShow()->where('expired_time', '>', now())->orderBy('created_at', 'desc')->get();

        return view('content.companies.show', ['company' => $company, 'provinceName' => $provinceName, 'posts' => $posts]);
    }
}
