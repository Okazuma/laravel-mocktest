<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\LoginRequest;


class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);

        // ユーザー登録ビューの設定
        Fortify::registerView(function () {
            return view('auth.register');
        });

        // ログインビューの設定
        Fortify::loginView(function () {
            return view('auth.login');
        });

        // ログインのレートリミッターの設定
        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;
            return Limit::perMinute(10)->by($email . $request->ip());
        });

        // メール認証ビューの設定
        // Fortify::verifyEmailView(function () {
        //     return view('auth.verify-email');
        // });


    //     Fortify::afterCreating(function ($user) {
    //     // 登録後にリダイレクトさせるためのコード
    //     return redirect()->route('login')->with('status', 'Verification email sent.');
    // });

    // Fortify::authenticateUsing(function (LoginRequest $request) {
    //         // バリデーションを通過した場合の処理
    //         if (Auth::attempt($request->only('email', 'password'))) {
    //             return redirect()->intended('/');
    //         }

    //         // バリデーションに失敗した場合の処理
    //         return back()->withErrors(['email' => '認証に失敗しました。']);
    //     });


    }
}