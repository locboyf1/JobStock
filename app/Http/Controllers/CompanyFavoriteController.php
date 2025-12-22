<?php

namespace App\Http\Controllers;

use App\Models\CompanyFavorite;
use Illuminate\Support\Facades\Auth;

class CompanyFavoriteController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $favorites = CompanyFavorite::where('user_id', $user->id)->paginate(5)->withQueryString();

        return view('content.companyfavorited.index', ['favorites' => $favorites]);
    }

    public function destroy($id)
    {
        $favorite = CompanyFavorite::find($id);
        if (! $favorite) {
            return redirect()->route('companyfavorite.index')->with('error', 'Công ty yêu thích không tồn tại');
        }
        $favorite->delete();

        return redirect()->route('companyfavorite.index')->with('success', 'Công ty yêu thích đã được xóa');
    }
}
