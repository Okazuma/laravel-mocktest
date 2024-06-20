<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;


class AuthController extends Controller
{

// 登録フォームの表示

    public function showRegisterForm()
    {
        return view('auth.register');
    }

// ーーーーーーーーーー



// ログインフォームの表示

    public function showLoginForm()
    {
        return view('auth.login');
    }

// ーーーーーーーーーー



// 会員登録処理

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('email.verify');
    }

// ーーーーーーーーーー



// ログイン処理

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // 認証成功時の処理
            if (!Auth::user()->hasVerifiedEmail()) {
                // 認証が完了していない場合、再度認証メールを送信
                Auth::user()->sendEmailVerificationNotification();
                return redirect()->route('email.verify')->with('resent', true);
            }

            return redirect()->intended('/');
        }

        return redirect()->back()->withErrors(['email' => 'ログイン情報が正しくありません。']);
    }

// ーーーーーーーーーー



// ログアウト処理

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        session()->flush();
        return redirect('/login');
    }

// ーーーーーーーーーー



// 　メール認証

    public function verifyEmail(EmailVerificationRequest $request)
    {
        $user = $request->user();

        // メールがすでに認証済みでないかを確認
        if ($user->hasVerifiedEmail()) {
            return redirect('/')->with('status', 'Your email is already verified.');
        }

        // メール認証を完了させる
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect('/')->with('status', 'Your email has been verified.');
    }

// ーーーーーーーーーー



// 認証メールの再送信

    public function resendVerificationEmail(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return redirect('/email/verify')->with('resent', true);
    }

// ーーーーーーーーーー

}
