<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    const AVATAR_DEFAULT = 'DEFAULT_AVATAR.jpg';

    public function login()
    {
        return view('content.auth.login');
    }

    public function postLogin(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            return redirect()->route('home')->with('success', 'Đăng nhập thành công');
        }

        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không đúng',
        ]);

    }

    public function register()
    {
        return view('content.auth.register');
    }

    public function postRegister(RegisterRequest $request)
    {
        $role = Role::where('alias', config('account.ROLE_USER'))->first();
        $validated = $request->validated();
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'],
            'role_id' => $role->id,
            'is_active' => true,
        ]);

        return redirect()->route('login')->with('success', 'Đăng ký thành công');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('home')->with('info', 'Bạn đã đăng xuất');
    }
}
