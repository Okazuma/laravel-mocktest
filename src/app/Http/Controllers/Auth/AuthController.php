<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
// use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth')->except(['register', 'showRegisterForm','showLoginForm','verify', 'sendEmailVerificationNotification']);
    //     $this->middleware('signed')->only('verify');
    //     $this->middleware('throttle:6,1')->only('sendEmailVerificationNotification');
    // }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // 認証成功時の処理
            return redirect()->intended('/');
        }

        
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        session()->flush();
        return redirect('/login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

// ログインフォームの表示
    public function showLoginForm()
    {
        return view('auth.login');
    }


// 会員登録処理
    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return redirect('/');

    }


    //     // ユーザー登録後にメールを送信
        // $user->sendEmailVerificationNotification();

        // Auth::login($user);

        // return redirect()->route('verification.notice');
    // }

    // public function show(Request $request)
    // {
    //     return view('auth.verify-email');
    // }

    // public function verify(Request $request, $id, $hash)
    // {
    //     if (! $request->user() || $request->user()->getKey() != $id) {
    //         return redirect('/login')->withErrors(['email' => 'Invalid verification link.']);
    //     }

    //     if ($request->user()->markEmailAsVerified()) {
    //         event(new Verified($request->user()));
    //     }

    //     return redirect('/home')->with('verified', true);
    // }

    // public function sendEmailVerificationNotification(Request $request)
    // {
    //     $request->user()->sendEmailVerificationNotification();

    //     return back()->with('message', 'Verification link sent!');
    // }
}
