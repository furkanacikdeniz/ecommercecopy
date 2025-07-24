<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use App\Models\User;



class AuthController extends Controller
{



    public function signInForm()
    {
        return view('frontend.auth.signInForm');
    }

    public function signIn(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $rememberMe = $request->get('remember_me',false);

        if(Auth::attempt($credentials, $rememberMe)) {
            // Authentication passed
            return redirect('/'); // Redirect to intended page or home
        } else {
            // Authentication failed
            return redirect()->back()->withErrors(['email' => 'Lütfen epostanızı kontrol ediniz','password'=>'Lütfen şifrenizi kontrol ediniz']);
        }
    }

    public function signUpForm()
    {
        return view('frontend.auth.signUpForm');
    }

    public function signUp(Request $request)
    {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
    ]);

    User::create([
        'name' => $request->name,
        'email' => strtolower($request->email),
        'password' => Hash::make($request->password),
        'is_admin' => false,
        'is_active' => true,
    ]);
    Auth::attempt(['email' => $request->email, 'password' => $request->password]);
    return redirect('/giris')->with('success', 'Kayıt başarılı! Hoş geldiniz!');
    }
    public function signOut()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Çıkış başarılı!');
    }
}
