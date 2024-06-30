@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <div class="stamp__alert">
        @if(session('success_message'))
            <div class="stamp alert-success">
                {{ session('success_message') }}
            </div>
        @endif

        @if(session('warning_message'))
            <div class="stamp alert-warning">
                {{session('warning_message') }}
            </div>
        @endif

        @if(session('error_message'))
            <div class="stamp alert-danger">
                {{ session('error_message') }}
            </div>
        @endif
    </div>

    <div class="stamp__container">
        @if (Auth::check())
        <div class="stamp__heading">
            <h2 class="stamp__ttl">{{ Auth::user()->name }}さんお疲れ様です！</h2>
        </div>
        @endif

        <div class="form">
            <div class="form__group">
                <div class="form__group-content">
                    <form class="form__button" action="{{route('start.work')}}" method="post">
                    @csrf
                        <button class="form__button--start-work" type="submit">
                            <span class="button-stamp">勤務開始</span>
                        </button>
                    </form>

                    <form class="form__button" action="{{route('end.work')}}" method="post">
                        @csrf
                        <button class="form__button--end-work" type="submit">
                            <span class="button-stamp">勤務終了</span>
                        </button>
                    </form>

                    <form class="form__button" action="{{route('start.break')}}" method="post">
                        @csrf
                        <button class="form__button--start-break" type="submit">
                            <span class="button-stamp">休憩開始</span>
                        </button>
                    </form>

                    <form class="form__button" action="{{route('end.break')}}" method="post">
                        @csrf
                        <button class="form__button--end-work" type="submit">
                            <span class="button-stamp">休憩終了</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection