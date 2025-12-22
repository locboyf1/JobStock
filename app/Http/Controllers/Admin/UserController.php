<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::whereHas('role', function ($q) {
            $q->whereNot('alias', config('account.ROLE_ADMIN'));
        })->paginate(4);

        return view('admin.user.index', ['users' => $users]);
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
        //
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

    public function status(string $id)
    {
        $user = User::findOrFail($id);
        if (! $user) {
            return redirect()->route('admin.user.index')->with('error', 'Không tìm thấy người dùng');
        }
        $status = $user->is_active;
        $user->update([
            'is_active' => ! $status,
        ]);

        return redirect()->route('admin.user.index')->with('success', 'Đã thay đổi trạng thái người dùng');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
