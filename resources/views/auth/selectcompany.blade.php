@extends('layouts.admin.companyselect')

@section('content')
    <div>
        <h3>Select your company</h3>
        <p>Select Company</p>
        
        @foreach($companies as $company)
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-6">
                        {{ $company->name }}
                    </div>
                    <div class="col-xs-6">
                        <a class="btn green" href="{{ route('admin.home', ['domain' => $company->slug]) }}">{{ __("Select") }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
