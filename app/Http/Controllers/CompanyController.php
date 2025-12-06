<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use App\Utilities\functions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $user = User::find($userId);
        $company = $user->company;
        if ($company == null) {
            return view('content.company.notify');
        }

        $provinceName = functions::getProvinceName($company->province_id);

        return view('content.company.show', ['company' => $company, 'provinceName' => $provinceName]);
    }

    public function terms()
    {
        $userId = Auth::id();
        $user = User::find($userId);
        $company = $user->company;

        $provinces = functions::getListProvince();

        if ($company != null) {
            return redirect()->Route('home');
        }

        return view('content.company.terms', ['provinces' => $provinces]);
    }

    public function store(StoreCompanyRequest $request)
    {
        $role = Role::where('alias', config('account.ROLE_COMPANY'))->first();
        $userId = Auth::id();
        $user = User::find($userId);
        $company = $user->company;
        if ($company != null) {
            return redirect()->route('home');
        }

        $logoPath = null;
        $confirmImagePath = null;

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('uploads/images', 'public');
        }

        if ($request->hasFile('confirm_image')) {
            $confirmImagePath = $request->file('confirm_image')->store('uploads/images', 'public');
        }

        $validated = $request->validated();
        $company = Company::create([
            'tax_code' => $validated['tax_code'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'title' => $validated['title'],
            'province_id' => $validated['province_id'],
            'address' => $validated['address'],
            'description' => $validated['description'],
            'content' => $validated['content'],
            'website' => $validated['website'],
            'facebook' => $validated['facebook'],
            'pinterest' => $validated['pinterest'],
            'youtube' => $validated['youtube'],
            'wikipedia' => $validated['wikipedia'],
            'linkedin' => $validated['linkedin'],
            'shop' => $validated['shop'],
            'logo' => $logoPath,
            'confirm_image' => $confirmImagePath,
            'is_show' => $request->input('is_show') ? 1 : 0,
            'users_id' => $userId,
        ]);

        $user->update([
            'company_id' => $company->id,
            'role_id' => $role->id,
        ]);

        return redirect()->route('home');
    }

    public function edit()
    {
        $userId = Auth::id();
        $user = User::find($userId);
        $company = $user->company;
        $provinces = functions::getListProvince();

        return view('content.company.edit', ['company' => $company, 'provinces' => $provinces]);
    }

    public function update(UpdateCompanyRequest $request, string $id)
    {
        $userId = Auth::id();
        $user = User::find($userId);
        $validated = $request->validated();
        $company = $user->company;

        if ($id != $company->id) {
            return abort(404);
        }

        $logoPath = $company->logo;
        if ($request->hasFile('logo')) {
            Storage::disk('public')->delete($logoPath);
            $logoPath = $request->file('logo')->store('uploads/images', 'public');
        }

        $confirmImagePath = $company->confirm_updated_image ? $company->confirm_updated_image : '';
        if ($request->hasFile('confirm_updated_image')) {
            Storage::disk('public')->delete($confirmImagePath);
            $confirmImagePath = $request->file('confirm_updated_image')->store('uploads/images', 'public');
        }

        $company->update([
            'tax_code' => $validated['tax_code'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'title' => $validated['title'],
            'province_id' => $validated['province_id'],
            'address' => $validated['address'],
            'description' => $validated['description'],
            'content' => $validated['content'],
            'website' => $validated['website'],
            'facebook' => $validated['facebook'],
            'pinterest' => $validated['pinterest'],
            'youtube' => $validated['youtube'],
            'wikipedia' => $validated['wikipedia'],
            'linkedin' => $validated['linkedin'],
            'shop' => $validated['shop'],
            'logo' => $logoPath,
            'confirm_updated_image' => $confirmImagePath ? $confirmImagePath : '',
            'is_confirmed' => null,
            'is_show' => $request->input('is_show') ? 1 : 0,
        ]);

        return redirect()->route('company.index');
    }
}
