@extends('layouts.admin.default')

@section('page-style')

@endsection

@section('page-content')
	<div class="portlet light">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-share font-dark hide"></i>
                <span class="caption-subject font-dark bold uppercase">Edit Permission</span>
            </div>
        </div>
        <div class="portlet-body form">
       		{!! Form::open(['route' => ['permissions.update', $permission->id], 'method' => 'PUT', 'class' => 'js-frm-edit-permission form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}
		    	@include('partial.admin.permissions.form',['from'=>'edit'])
			{{ Form::close() }}
        </div>
    </div>
@endsection

@section('page-script')

@endsection