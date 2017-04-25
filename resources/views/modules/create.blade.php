@extends('layouts.admin.default')

@section('page-content')
	<div class="portlet light">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-share font-dark hide"></i>
                <span class="caption-subject font-dark bold uppercase">Add Module</span>
            </div>
        </div>
        <div class="portlet-body form">
       		{!! Form::open(['route' => 'modules.store', 'class' => 'js-frm-create-module form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}
		    	@include('partial.admin.modules.form',['from'=>'add'])
			{{ Form::close() }}
        </div>
    </div>
@endsection

@section('page-script')
    <script src="{{ asset('js/admin/modules.js') }}" type="text/javascript"></script>
@endsection