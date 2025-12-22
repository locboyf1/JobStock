<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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

            $user = User::where('email', $request->email)->first();
            if ($user->is_active != 1) {
                Auth::logout();

                return redirect()->route('login')->with('error', 'Tài khoản của bạn đã bị khóa');
            }

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

    public function forgetPassword()
    {
        return view('content.auth.forgetpassword');
    }

    public function postForgetPassword(ForgetPasswordRequest $request)
    {
        $validated = $request->validated();
        $email = $validated['email'];
        $otp = rand(100000, 999999);
        Cache::put('otp_'.$email, $otp, now()->addMinutes(5));

        session()->put('reset_password_confirm', $email);

        Mail::html('Mã OTP của bạn là: <b>'.$otp.'</b><br>Vui lòng không chia sẻ mã OTP này với ai đó.<br>Cảm ơn bạn đã sử dụng JobStock', function ($message) use ($email) {
            $message->to($email)->subject('JobStock - Mã OTP để reset mật khẩu');
        });

        return redirect()->route('resetPassword')->with('success', 'Mã OTP đã được gửi đến email của bạn');
    }

    public function resetPassword()
    {
        $email = session()->get('reset_password_confirm');
        if (! $email) {
            return redirect()->route('forgetPassword');
        }

        $otp = Cache::get('otp_'.$email);
        if (! $otp) {
            return redirect()->route('forgetPassword')->with('info', 'Mã OTP đã hết hạn');
        }

        return view('content.auth.resetpassword');
    }

    public function postResetPassword(ResetPasswordRequest $request)
    {
        $email = session()->get('reset_password_confirm');
        if (! $email) {
            return redirect()->route('forgetPassword')->with('info', 'Mã OTP đã hết hạn');
        }

        $otp = Cache::get('otp_'.$email);
        if (! $otp) {
            return redirect()->route('forgetPassword')->with('info', 'Mã OTP đã hết hạn');
        }

        $validated = $request->validated();
        if ($validated['otp'] != $otp) {
            return redirect()->route('resetPassword')->with('info', 'Mã OTP không đúng');
        }

        $user = User::where('email', $email)->first();
        $password = Str::password(10);
        $user->update([
            'password' => Hash::make($password),
        ]);
        session()->forget('reset_password_confirm');
        Cache::forget('otp_'.$email);

        Mail::html('Mật khẩu mới của bạn là: <b>'.$password.'</b><br>Vui lòng thay đổi mật khẩu ngay khi đăng nhập.<br>Cảm ơn bạn đã sử dụng JobStock', function ($message) use ($email) {
            $message->to($email)->subject('JobStock - Mật khẩu mới');
        });

        return redirect()->route('login')->with('success', 'Mật khẩu mới đã gửi đến email của bạn');
    }
}
