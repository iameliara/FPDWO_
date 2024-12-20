<?php

// Penanggung jawab : Miko

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginHTML(Request $request)
    {
        if (Auth::guard('pegawai')->check()) {
            return redirect()->route('pegawai.dashboard');
        }

        return view('pegawai.login');
    }

    public function loginSESS(Request $request)
    {
        $nik = $request->input('nik');
        $password = $request->input('password');

        if (!Auth::guard('pegawai')->attempt(['nik' => $nik, 'password' => $password])) {
            return back()->withErrors(['error' => 'Kredensial tidak valid'])->withInput();
        }

        return redirect()->route('pegawai.dashboard')->with('status', 'Halo, '.Auth::guard('pegawai')->user()->nama.'!');
    }

    public function logoutSESS(Request $request)
    {
        Auth::guard('pegawai')->logout();
        return redirect()->route('pegawai.login');
    }
}
