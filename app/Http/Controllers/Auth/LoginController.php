<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Alert;
class LoginController extends Controller
{

    public function index()
    {
        return redirect()->route('auth.login');
    }
    
    public function login()
    {
        return view('auth.Login');
    }

    public function authenticate(Request $request) : RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email:dns'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            toast('Selamat datang kembali ' . Auth::user()->name . '!','success');
            return redirect()->intended('dashboard');
        }
 
        toast('Upss! Email atau Password salah!','error');
        return redirect()->back();
    }

    //Logout
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        toast('Anda berhasil logout!','success');
        return redirect('/');
    }
}
