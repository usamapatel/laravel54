@extends('layouts.admin.default')

@section('page-content')
	<div class="portlet light">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                <span class="caption-subject bold uppercase font-dark">Add Module</span>
            </div>
        </div>
        <div class="portlet-body form">
       		{!! Form::open(['route' => ['modules.store', 'domain' => app('request')->route()->parameter('company')], 'class' => 'js-frm-create-module form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}
		    	@include('partial.admin.modules.form',['from'=>'add'])
			{{ Form::close() }}
        </div>
    </div>
@endsection

@section('page-script')
    <script src="{{ asset('js/admin/modules.js') }}" type="text/javascript"></script>
@endsection