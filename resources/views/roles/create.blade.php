@extends('layouts.admin.default')

@section('page-style')

@endsection

@section('page-content')
	<div class="portlet light">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-share font-dark hide"></i>
                <span class="caption-subject">Add Role</span>
            </div>
        </div>
        <div class="portlet-body form">
       		{!! Form::open(['route' => ['roles.store', 'domain' => app('request')->route()->parameter('company')], 'class' => 'js-frm-create-role form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}
		    	@include('partial.admin.roles.form',['from'=>'add'])
			{{ Form::close() }}
        </div>
    </div>
@endsection

@section('page-script')
    <script src="{{ asset('js/admin/roles.js') }}" type="text/javascript"></script>
@endsection