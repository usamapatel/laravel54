@extends('layouts.admin.auth')

@section('auth-content')
    <div class="login-content">
        <h1>Login</h1>
        <p> Lorem ipsum dolor sit amet, coectetuer adipiscing elit sed diam nonummy et nibh euismod aliquam erat volutpat. </p>
        <form class="login-form" role="form" method="POST" action="{{ route('login', ['domain' => app('request')->route()->parameter('company')]) }}">
            {{ csrf_field() }}

            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button>
                <span>{{ __("Enter any username and password.") }} </span>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <input class="form-control form-control-solid placeholder-no-fix form-group" type="email" id="email" autocomplete="off" placeholder="{{ __("Email") }}" name="email" value="{{ old('email') }}" required/>
                </div>
                <div class="col-xs-6">
                    <input class="form-control form-control-solid placeholder-no-fix form-group" id="password" type="password" autocomplete="off" placeholder="{{ __("Password") }}" name="password" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="rem-password">
                        <label class="rememberme mt-checkbox mt-checkbox-outline">
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}/> {{ __("Remember me") }}
                            <span></span>
                        </label>
                    </div>
                </div>
                <div class="col-sm-8 text-right">
                    <div class="forgot-password">
                        <a href="javascript:;" id="forget-password" class="forget-password" href="{{ route('password.request', ['domain' => app('request')->route()->parameter('company')]) }}">Forgot Password?</a>
                    </div>
                    <button class="btn green" type="submit">{{ __("Sign In") }}</button>
                </div>
            </div>
        </form>
        <!-- BEGIN FORGOT PASSWORD FORM -->
        <form class="forget-form login-form" role="form" method="POST" action="{{ route('password.email', ['domain' => app('request')->route()->parameter('company')]) }}">
            {{ csrf_field() }}
            <h3 class="font-green">{{ __("Forgot Password?") }}</h3>
            <p> {{ __("Enter your e-mail address below to reset your password.") }} </p>
            <div class="form-group">
                <input class="form-control placeholder-no-fix form-group" type="email" autocomplete="off" placeholder="{{ __("Email") }}" name="email" value="{{ old('email') }}" required/>
            </div>
            <div class="form-actions">
                <button type="button" id="back-btn" class="btn green btn-outline">{{ __("Back") }}</button>
                <button type="submit" class="btn btn-success uppercase pull-right">{{ __("Submit") }}</button>
            </div>
        </form>
        <!-- END FORGOT PASSWORD FORM -->
    </div>
@endsection
