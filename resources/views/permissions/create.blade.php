@extends('layouts.admin.default')

@section('page-style')

@endsection

@section('page-content')
	<div class="portlet light">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-share font-dark hide"></i>
                <span class="caption-subject font-dark bold uppercase">Add Permission</span>
            </div>
        </div>
        <div class="portlet-body form">
       		{!! Form::open(['route' => 'permissions.store', 'class' => 'js-frm-create-permission form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}
		    	@include('partial.admin.permissions.form', ['from'=>'add'])
			{{ Form::close() }}
        </div>
    </div>
@endsection

@section('page-script')
    <script type="text/javascript" src="{{ asset('js/admin/permission.js') }}"></script>
@endsection