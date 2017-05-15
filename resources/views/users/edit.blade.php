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
       		{!! Form::open(['route' => ['users.update', 'domain' => app('request')->route()->parameter('company'), 'userId' => $user->id], 'method' => 'PUT', 'class' => 'js-frm-edit-user form-horizontal', 'role' => 'form', 'id' => 'submit_edit_user_form']) !!}
		    	{{-- @include('partial.admin.users.form',['from'=>'edit']) --}}
                <div class="form-body">
                    <div class="form-row col-md-6 clearfix">
                        <div class="form-col-1">
                            <label class="label">Email </label>
                        </div>                        
                        <div class="p-r-5 input-wrapper right">
                            {!! Form::email('email', $user->email, ['class' => 'form-control', 'id' => 'email', 'readonly' => Auth::user()->id != $user->id ? 'readonly' : null]) !!}
                        </div>
                    </div>

                    <div class="form-row col-md-6 clearfix">
                        <div class="form-col-1">
                            <label class="label">Roles </label>
                        </div>
                        <div class="p-r-5 input-wrapper right">
                            <div class="row">                                            
                                <div class="col-md-12">                                                    
                                    {!! Form::select('roles[]', $roles, $companyWiseRoles, array('class' =>'js-select2-multiselect form-control', 'multiple' => true)) !!}
                                </div>                                            
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="form-row col-md-6 clearfix">
                            <div class="form-col-1">
                                <label class="label">Name </label>
                            </div>
                            <div class="p-r-5 input-wrapper right">
                                {!! Form::text('first_name', $user->person->first_name,['class' => 'form-control', 'readonly' => Auth::user()->id != $user->id ? 'readonly' : null]) !!}
                            </div>
                        </div>
                        <div class="form-row col-md-6 clearfix">
                            <div class="form-col-1">
                                <label class="label">Last Name </label>
                            </div>
                            <div class="p-r-5 input-wrapper right">
                                {!! Form::text('last_name', $user->person->last_name,['class' => 'form-control', 'readonly' => Auth::user()->id != $user->id ? 'readonly' : null]) !!}
                            </div>
                        </div>
                        <div class="form-row col-md-6 clearfix">
                            <div class="form-col-1">
                                <label class="label">Username </label>
                            </div>
                            <div class="p-r-5 input-wrapper right">
                                {!! Form::text('username', $user->username,['class' => 'form-control', 'readonly' => Auth::user()->id != $user->id ? 'readonly' : null]) !!}
                            </div>
                        </div>
                        <div class="form-row col-md-6 clearfix">
                            <div class="form-col-1">
                                <label class="label">Created at </label>
                            </div>
                            <div class="p-r-5 input-wrapper right">
                                <div class='input-group date js-form-datetimepicker'>
                                    {!! Form::text('banned_at', Carbon\Carbon::parse($user->banned_at)->format('d/m/Y h:i A'),
                                    ['class' => 'form-control', 'id' => 'banned_at', 'readonly' => 'readonly']) !!}
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="">
                            <div class="col-md-12">
                                <button type="submit" class="uie-btn uie-btn-primary save-btn">Submit</button>
                                <a class="uie-btn uie-secondary-btn reset-btn" href="{{ route('users.index', ['domain' => app('request')->route()->parameter('company')]) }}">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" value="{{ $user->id }}" name="user_id"></input>
			{{ Form::close() }}
        </div>
    </div>
@endsection

@section('page-script')
    <script src="{{ asset('js/admin/users.js') }}" type="text/javascript"></script>
@endsection