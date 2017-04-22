@extends('layouts.admin.auth')

@section('auth-content')
    <div class="login-content">
        <h1>Registration</h1>
        <p> Lorem ipsum dolor sit amet, coectetuer adipiscing elit sed diam nonummy et nibh euismod aliquam erat volutpat. Lorem ipsum dolor sit amet, coectetuer adipiscing. </p>
        <form class="login-form" role="form" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button>
                <span>Please fill up required fields.</span>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" id="name" autocomplete="off" placeholder="Name" name="name" value="{{ old('name') }}" required/>
                </div>
                <div class="col-xs-6">
                    <input class="form-control form-control-solid placeholder-no-fix form-group" id="email" type="email" autocomplete="off" value="{{ old('email') }}" placeholder="Email" name="email" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <input class="form-control form-control-solid placeholder-no-fix form-group" type="password" id="password" autocomplete="off" id="password" placeholder="Password" name="password" required/>
                </div>
                <div class="col-xs-6">
                    <input class="form-control form-control-solid placeholder-no-fix form-group" id="password-confirm" type="password" autocomplete="off" placeholder="Confirm Password" name="password_confirmation" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <button class="btn green" type="submit">Register</button>
                </div>
            </div>
        </form>
    </div>
@endsection
