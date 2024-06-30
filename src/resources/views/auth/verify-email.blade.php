@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/verify-email.css') }}">
@endsection

@section('content')
    <div class="verify__container">

        <div class="verify__heading">
            <h2 class="verify__ttl">会員登録完了</h2>
        </div>

        <div class="verify__content">
            <div class="verify__content__text">
                <p class="verify__content__text-msg">認証用メールを送信したので登録の確認を行ってください。</p>
            </div>

            @if (session('resent'))
            <div class="alert alert-success" role="alert">
                <p class="alert-msg">新しい確認用のリンクを送信しました！</p>
            </div>
            @endif

            <div class="verify__content__resend">
                <p class="verify__content__resend-msg">認証メールが届かない方はこちら</p>
                <form class="verify__button" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                    <button type="submit" class="verify__button-resend">{{ __('再送信') }}</button>
                </form>
            </div>

            <div class="back__button">
                <a class="back__button-register" href="{{route('register')}}">新規登録</a>
            </div>
        </div>

    </div>
@endsection