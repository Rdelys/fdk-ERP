<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'code' => 'required',
        ]);

        if ($request->code == env('ADMIN_CODE', '1234')) {
            session(['is_admin' => true]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['code' => 'Code incorrect']);
    }

    public function logout()
    {
        session()->forget('is_admin');
        return redirect()->route('admin.login');
    }
}