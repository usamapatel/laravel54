@extends('layouts.admin.auth')

@section('auth-content')
    <div class="login-content">
        <h1>Registration</h1>
        <form class="login-form" role="form" method="POST" action="{{ route('register', ['domain' => app('request')->route()->parameter('company')]) }}">
            {{ csrf_field() }}

            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button>
                <span>{{ __("Please fill up required fields.") }}</span>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" id="company_name" autocomplete="off" placeholder="{{ __("Company Name") }}" name="company_name" value="{{ old('company_name') }}" required/>
                </div>
                <div class="col-xs-6">
                    <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" id="company_slug" autocomplete="off" placeholder="{{ __("Company Slug") }}" name="company_slug" value="{{ old('company_slug') }}" readonly="readonly" />
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" id="name" autocomplete="off" placeholder="{{ __("Name") }}" name="name" value="{{ old('name') }}" required/>
                </div>
                <div class="col-xs-6">
                    <input class="form-control form-control-solid placeholder-no-fix form-group" id="email" type="email" autocomplete="off" value="{{ old('email') }}" placeholder="{{ __("Email") }}" name="email" required/>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ __($errors->first('email')) }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <input class="form-control form-control-solid placeholder-no-fix form-group" type="password" id="password" autocomplete="off" id="password" placeholder="{{ __("Password") }}" name="password" required/>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ __($errors->first('password')) }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-xs-6">
                    <input class="form-control form-control-solid placeholder-no-fix form-group" id="password-confirm" type="password" autocomplete="off" placeholder="{{ __("Confirm Password") }}" name="password_confirmation" required/>

                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ __($errors->first('password_confirmation')) }}</strong>
                        </span>
                    @endif
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

@section('page-script')
    <script src="{{ asset('js/admin/auth.js') }}" type="text/javascript"></script>
@endsection
