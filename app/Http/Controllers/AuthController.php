<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $request->validate([
            'login_field' => 'required',
            'password' => 'required',
        ]);

        $credentials = [
            'nis_nip' => $request->login_field,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->level === 'admin') {
                return redirect()->intended('/admin');
            }

            return redirect()->intended('/siswa');
        }

        return back()->withErrors([
            'login_field' => 'Kredensial (NIS/NIP atau Password) salah.',
        ])->onlyInput('login_field');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/'); // Balik ke halaman login siswa atau admin
    }
}
