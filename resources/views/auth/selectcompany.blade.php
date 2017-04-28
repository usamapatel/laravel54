@extends('layouts.admin.auth')

@section('auth-content')
    <div class="login-content">
        <h1>Sign in to your company</h1>
        <p>Enter your company’s URL.</p>
        <form class="selectcompany-form" role="form" method="POST" action="{{ route('check.selected.company', ['domain' => app('request')->route()->parameter('company')]) }}">
            {{ csrf_field() }}

            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button>
                <span>{{ __("Enter company url.") }} </span>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <input class="form-control form-control-solid placeholder-no-fix form-group" dir="rtl" type="text" id="company_slug" autocomplete="off" placeholder="{{ __("your-company-url") }}" name="company_slug" value="{{ old('company_slug') }}" />
                </div>
                <div class="col-xs-6">
                    {{ "." . config('config-variables.app.domain') }}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    @if ($errors->has('company_slug'))
                        <span class="help-block">
                            <strong>{{ __($errors->first('company_slug')) }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-right">
                    <button class="btn green" type="submit">{{ __("Continue") }}</button>
                </div>
            </div>
        </form>
    </div>
@endsection
