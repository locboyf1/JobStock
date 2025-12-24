<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ChangeProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('content.profile.index', ['user' => $user]);
    }

    public function update(ChangeProfileRequest $request)
    {
        $validated = $request->validated();
        $user = Auth::user();
        $avatarPath = $user->avatarPath;
        if ($request->hasFile('avatar')) {
            Storage::disk('public')->delete($avatarPath);
            $avatarPath = $request->file('avatar')->store('uploads/images', 'public');
        }

        $user->update([
            'avatar' => $avatarPath,
            'name' => $validated['name'],
            'phone' => $validated['phone'],
        ]);

        return redirect()->route('profile.index')->with('success', 'Hồ sơ đã được cập nhật');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $validated = $request->validated();
        $user = Auth::user();
        $credentials = [
            'email' => $user->email,
            'password' => $validated['old_password'],
        ];

        if (! Auth::attempt($credentials)) {
            return redirect()->back()->withErrors([
                'old_password' => 'Mật khẩu cũ không chính xác',
            ]);
        }

        $user->update([
            'password' => bcrypt($validated['password']),
        ]);

        return redirect()->route('profile.index')->with('success', 'Mật khẩu đã được thay đổi');
    }
}
