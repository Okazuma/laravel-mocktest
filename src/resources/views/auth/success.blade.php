@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/success.css') }}">
@endsection

@section('content')
<div class="success__container">
    <div class="success__inner">
        <div class="back__button">
                    <a class="back__button-login" href="{{route('login')}}">TOPへ戻る</a>
                    
        </div>
    </div>
</div>
@endsection