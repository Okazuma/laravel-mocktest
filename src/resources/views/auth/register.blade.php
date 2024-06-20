@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
    <div class="register__container">
        <div class="register__heading">
            <h2 class="register__ttl">会員登録</h2>
        </div>

        <form class="form" action="/register" method="post">
            @csrf
            <div class="form__group">
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="name" placeholder="名前" autocomplete="name" value="{{ old('name') }}" />
                        <div class="form__error">
                            @error('name')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>

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

                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="password" name="password_confirmation"  placeholder="確認用パスワード" />
                        <div class="form__error">
                            @error('password_confirmation')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form__button">
                    <button class="form__button-submit" type="submit">会員登録</button>
                </div>

            </div>
        </form>

        <div class="register__footer">
            <span class=register__footer-text>アカウントをお持ちの方はこちら</span><br>
            <a class="register__button-login" href="{{route('login')}}">ログイン</a>
        </div>
    </div>

@endsection