<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Static_;

class AuthController extends Controller
{
    CONST  AVATAR_DEFAULT = 'https://media.istockphoto.com/id/1726213993/vector/default-avatar-profile-placeholder-abstract-vector-silhouette-element.jpg?s=612x612&w=0&k=20&c=nYlk0j076CBZ5xGCCaVXtISYGK2SzXRwuQBXPkfmMX4=';


    public function login()
    {
        return view('content.auth.login');
    }

    public function postLogin(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
         
            $request->session()->regenerate();
            return redirect()->route('home');
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
       $validated = $request->validated();
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'],
            'role_id' => config('account.ROLE_USER'),
            'avatar' => self::AVATAR_DEFAULT,
            'is_active' => true
        ]);
        return redirect(route('login'));
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('home');
    }
}
