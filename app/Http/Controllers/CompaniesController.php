<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyFavorite;
use Illuminate\Support\Facades\Auth;

class CompaniesController extends Controller
{
    public function index()
    {
        return view('content.companies.index');
    }

    public function show(string $id)
    {
        $user = Auth::user();
        $company = Company::find($id);
        if (! $company || ! $company->is_confirmed) {
            return redirect()->route('companies.index')->with('error', 'Công ty không tồn tại');
        }

        $posts = $company->jobs()->isShow()->where('expired_time', '>', now())->orderBy('created_at', 'desc')->get();

        $favorite = false;
        if ($user) {
            $favorited = CompanyFavorite::where('user_id', $user->id)->where('company_id', $company->id)->first();
            if ($favorited) {
                $favorite = true;
            }
        }

        return view('content.companies.show', ['company' => $company, 'posts' => $posts, 'favorite' => $favorite]);
    }

    public function favorite(string $id)
    {
        $user = Auth::user();
        if (! $user) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để lưu công ty vào danh sách yêu thích');
        }

        $company = Company::find($id);
        if (! $company || ! $company->is_confirmed) {
            return redirect()->route('companies.index')->with('error', 'Công ty không tồn tại');
        }

        $favorite = CompanyFavorite::where('user_id', $user->id)->where('company_id', $company->id)->first();
        if ($favorite) {
            $favorite->delete();

            return redirect()->route('companies.show', $company->id)->with('success', 'Đã xóa công ty khỏi danh sách yêu thích');
        }

        CompanyFavorite::create([
            'user_id' => $user->id,
            'company_id' => $company->id,
        ]);

        return redirect()->route('companies.show', $company->id)->with('success', 'Đã lưu công ty vào danh sách yêu thích');
    }
}
