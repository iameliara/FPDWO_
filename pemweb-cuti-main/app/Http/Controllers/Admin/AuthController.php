<?php

// Penanggung jawab : Miko

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginHTML(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function loginSESS(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if (!Auth::guard('admin')->attempt(['email' => $email, 'password' => $password])) {
            return back()->withErrors(['error' => 'Kredensial tidak valid'])->withInput();
        }

        return redirect()->route('admin.dashboard')->with('status', 'Halo, '.Auth::guard('admin')->user()->nama.'!');
    }

    public function logoutSESS(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
