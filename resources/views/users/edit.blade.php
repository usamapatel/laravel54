@extends('layouts.admin.default')
@section('page-style')
@endsection
@section('page-content')
	<div class="portlet light">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-share font-dark hide"></i>
                <span class="caption-subject font-dark bold uppercase">Edit Users</span>
            </div>
        </div>
        <div class="portlet-body form">
       		{!! Form::open(['route' => ['users.update', $user->id], 'method' => 'PUT', 'class' => 'js-frm-edit-user form-horizontal', 'role' => 'form']) !!}
		    	@include('partial.admin.users.form',['from'=>'edit'])
                <input type="hidden" value="{{ $user->id }}" name="user_id"></input>
			{{ Form::close() }}
        </div>
    </div>
@endsection

@section('page-script')
    <script src="{{ asset('js/admin/users.js') }}" type="text/javascript"></script>
@endsection