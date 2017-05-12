@extends('layouts.admin.default')

@section('page-style')

@endsection

@section('page-content')
	<div class="portlet light">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-share font-dark hide"></i>
                <span class="caption-subject font-dark bold uppercase">Edit Module</span>
            </div>
        </div>
        <div class="portlet-body form">
       		{!! Form::open(['route' => ['modules.update', 'domain' => app('request')->route()->parameter('company'), 'moduleId' => $module->id], 'method' => 'PUT', 'class' => 'js-frm-edit-module form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}
		    	@include('partial.admin.modules.form', ['from'=>'edit'])
			{{ Form::close() }}
        </div>
    </div>
@endsection

@section('page-script')
    <script src="{{ asset('js/admin/modules.js') }}" type="text/javascript"></script>
@endsection