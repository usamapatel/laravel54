@extends('layouts.admin.companyselect')

@section('content')
    <div>
        <h3 class="caption-subject">Select your company</h3>
        <p>Select Company</p>
        
        @foreach($companies as $company)
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-9">
                        <label class="company_name">
                            {{ $company->name }}
                        </label>
                    </div>
                    <div class="col-xs-3">
                        <a class="btn uie-btn uie-btn-primary pull-right" href="{{ route('admin.home', ['domain' => $company->slug]) }}">{{ __("Select") }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
