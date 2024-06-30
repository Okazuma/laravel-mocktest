@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
    <div class="login__container">

        <div class="login__heading">
            <h2 class="login__ttl">ログイン</h2>
        </div>

        <form class="form" action="/login" method="post">
        @csrf

            <div class="form__group">
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="email" placeholder="メールアドレス" autocomplete="email" value="{{ old('email') }}" >
                        <div class="form__error">
                            @error('email')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="password" name="password" placeholder="パスワード" value="{{ old('password' )}}">
                        <div class="form__error">
                            @error('password')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form__button">
                    <button class="form__button-submit" type="submit">ログイン</button>
                </div>
            </div>

        </form>

        <div class="login__footer">
            <span class=login__footer-text>アカウントをお持ちでない方はこちら</span><br>
                <a class="login__button-register" href="{{route('register')}}">会員登録</a>
        </div>

    </div>
@endsection