<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Models\Company;
use App\Models\User;
use App\Utilities\functions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class CompanyController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $user = User::find($userId);
        $company = $user->company;
        if($company == null){
            return view('content.company.notify');
        }

        return redirect()->route('home');
    }

    public function terms(){
        $userId = Auth::id();
        $user = User::find($userId);
        $company = $user->company;

        $provinces = functions::getListProvince();

        if($company != null){
            return redirect()-> Route('home');
        }
        return view('content.company.terms', ['provinces' => $provinces]);
    }

    public function store(StoreCompanyRequest $request){
        $userId = Auth::id();
        $user = User::find($userId);
        $company = $user->company;
        if($company != null){
            return redirect()->route('home');
        }

        $logoPath = null;
        $confirmImagePath = null;

        if($request->hasFile('logo')){
             $logoPath = $request->file('logo')->store('uploads/images', 'public');
        }

        if($request->hasFile('confirm_image')){
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
            'users_id' => $userId
        ]);

        $user->update([
            'company_id' => $company->id,
            'role_id' => config('account.ROLE_COMPANY')
        ]);
        
        return redirect()->route('home');
    }
}
