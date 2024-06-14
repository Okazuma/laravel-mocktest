@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Success') }}</div>

                <div class="card-body">
                    {{ __('Registration successful! Please check your email for the verification link.') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection