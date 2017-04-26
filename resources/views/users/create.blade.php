@extends('layouts.admin.default')

@section('page-style')

@endsection
@section('page-content')
	<div class="portlet light">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-share font-dark hide"></i>
                <span class="caption-subject font-dark bold uppercase">Add Users</span>
            </div>
        </div>
        <div class="portlet-body form">
       		{!! Form::open(['route' => ['users.store', 'domain' => app('request')->route()->parameter('company')], 'class' => 'js-frm-create-user form-horizontal', 'role' => 'form']) !!}
		    	@include('partial.admin.users.form',['from'=>'add'])
			{{ Form::close() }}
        </div>
    </div>
@endsection
@section('page-script')
    <script src="{{ asset('js/admin/users.js') }}" type="text/javascript"></script>
@endsection