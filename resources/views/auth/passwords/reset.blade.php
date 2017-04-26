@extends('layouts.admin.auth')

@section('auth-content')
    <div class="login-content">
        <h1>Set your new password.</h1>
        <p> Lorem ipsum dolor sit amet, coectetuer adipiscing elit sed diam nonummy et nibh euismod aliquam erat volutpat. Lorem ipsum dolor sit amet, coectetuer adipiscing. </p>
        <form class="login-form" role="form" method="POST" action="{{ route('password.request', ['domain' => app('request')->route()->parameter('company')]) }}">
            {{ csrf_field() }}

            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button>
                <span>Please fill up required fields.</span>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <input class="form-control form-control-solid placeholder-no-fix form-group" id="email" type="email" autocomplete="off" value="{{ $email or old('email') }}" placeholder="Email" name="email" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <input class="form-control form-control-solid placeholder-no-fix form-group" type="password" id="password" autocomplete="off" placeholder="Password" name="password" required/>
                </div>
                <div class="col-xs-6">
                    <input class="form-control form-control-solid placeholder-no-fix form-group" id="password-confirm" type="password" autocomplete="off" placeholder="Confirm Password" name="password_confirmation" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <button class="btn green" type="submit">Reset Password</button>
                </div>
            </div>
        </form>
    </div>
@endsection
