@extends('layouts.app')

@section('content')
<div>
    <h1>Email Verification</h1>
    <p>Thank you for registering! Please check your email and click the verification link to verify your email address.</p>
    @if (session('message'))
        <div>{{ session('message') }}</div>
    @endif
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit">Resend Verification Email</button>
    </form>
</div>
@endsection