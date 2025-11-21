<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

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
        if (!$company) {
            return abort(404);
        }
        return view('admin.company.show', ['company' => $company]);
    }

    public function approve(string $id)
    {
        $company = Company::find($id);
        if (!$company) {
            return abort(404);
        }
        $company->update([
            'is_confirmed' => 1
        ]);
        return redirect()->route('admin.company.index');
    }

    public function unapprove(string $id)
    {
        $company = Company::find($id);
        if (!$company) {
            return abort(404);
        }
        $company->update([
            'is_confirmed' => 0
        ]);
        return redirect()->route('admin.company.index');
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
