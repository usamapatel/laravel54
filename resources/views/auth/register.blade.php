@extends('layouts.admin.auth')

@section('auth-content')
    <div class="login-content">
        <h1>{{ __("Registration") }}</h1>
        <p> {{ __("Lorem ipsum dolor sit amet, coectetuer adipiscing elit sed diam nonummy et nibh euismod aliquam erat volutpat. Lorem ipsum dolor sit amet, coectetuer adipiscing.") }} </p>
        <form class="login-form" role="form" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button>
                <span>{{ __("Please fill up required fields.") }}</span>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" id="name" autocomplete="off" placeholder="{{ __("Name") }}" name="name" value="{{ old('name') }}" required/>
                </div>
                <div class="col-xs-6">
                    <input class="form-control form-control-solid placeholder-no-fix form-group" id="email" type="email" autocomplete="off" value="{{ old('email') }}" placeholder="{{ __("Email") }}" name="email" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <input class="form-control form-control-solid placeholder-no-fix form-group" type="password" id="password" autocomplete="off" id="password" placeholder="{{ __("Password") }}" name="password" required/>
                </div>
                <div class="col-xs-6">
                    <input class="form-control form-control-solid placeholder-no-fix form-group" id="password-confirm" type="password" autocomplete="off" placeholder="{{ __("Confirm Password") }}" name="password_confirmation" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <button class="btn green" type="submit">{{ __("Register") }}</button>
                </div>
            </div>
        </form>
    </div>
@endsection
