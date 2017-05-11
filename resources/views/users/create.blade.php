@extends('layouts.admin.default')

@section('page-style')

@endsection
@section('page-content')
	<div class="portlet light">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-newspaper-o"></i>
                <span class="caption-subject bold uppercase font-dark">Add Users
                    <span class="step-title"> - Step 1 of 2 </span>
                </span>                
            </div>
        </div>
        <div class="portlet-body form" id="user_form_wizard">
       		{!! Form::open(['route' => ['users.store', 'domain' => app('request')->route()->parameter('company')], 'class' => 'js-frm-create-user form-horizontal', 'role' => 'form', 'id' => 'submit_user_form']) !!}
                <div class="form-wizard">
    		    	<div class="form-body">
                        <ul class="nav nav-pills nav-justified steps">
                            <li>
                                <a href="#account_setup" data-toggle="tab" class="step">
                                    <span class="number"> 1 </span>
                                    <span class="desc">
                                        <i class="fa fa-check"></i> Account Setup </span>
                                </a>
                            </li>
                            <li>
                                <a href="#profile_setup" data-toggle="tab" class="step">
                                    <span class="number"> 2 </span>
                                    <span class="desc">
                                        <i class="fa fa-check"></i> Profile Setup </span>
                                </a>
                            </li>                        
                        </ul>
                        <div id="bar" class="progress progress-striped" role="progressbar">
                            <div class="progress-bar progress-bar-success"> </div>
                        </div>
                        <div class="tab-content">
                            <div class="alert alert-danger display-none">
                                <button class="close" data-dismiss="alert"></button> You have some form errors. Please check below. 
                            </div>
                            <div class="alert alert-success display-none">
                                <button class="close" data-dismiss="alert"></button> Your form validation is successful! 
                            </div>
                            <div class="tab-pane js-tab-pane active" id="account_setup">
                                <h3 class="block">Provide your account details</h3>
                                <div class="form-group">
                                    <div class="form-row col-md-6 clearfix">
                                        <div class="form-col-1">
                                            <label class="label">Email </label>
                                        </div>
                                        <div class="p-r-5 input-wrapper right">
                                            {!! Form::email('email', null,['class' => 'form-control', 'id' => 'email']) !!}
                                        </div>
                                    </div>
                                    <div class="form-row col-md-6 clearfix">
                                        <div class="form-col-1">
                                            <label class="label">Roles </label>
                                        </div>
                                        <div class="p-r-5 input-wrapper right">
                                            <div class="row">                                            
                                                <div class="col-md-12">                                                    
                                                    {!! Form::select('roles[]', $roles, null, array('class' =>'js-select2-multiselect form-control', 'multiple' => true)) !!}
                                                </div>                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane js-tab-pane" id="profile_setup">
                                <div class="js-profile-details">
                                    <h3 class="block">Provide your profile details</h3>
                                    <div class="form-group">
                                        <div class="form-row col-md-6 clearfix">
                                            <div class="form-col-1">
                                                <label class="label">Name </label>
                                            </div>
                                            <div class="p-r-5 input-wrapper right">
                                                {!! Form::text('first_name', null,['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="form-row col-md-6 clearfix">
                                            <div class="form-col-1">
                                                <label class="label">Last Name </label>
                                            </div>
                                            <div class="p-r-5 input-wrapper right">
                                                {!! Form::text('last_name', null,['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                         <div class="form-row col-md-6 clearfix">
                                            <div class="form-col-1">
                                                <label class="label">Username </label>
                                            </div>
                                            <div class="p-r-5 input-wrapper right">
                                                {!! Form::text('username', null,['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="form-row col-md-6 clearfix">
                                            <div class="form-col-1">
                                                <label class="label">Created at </label>
                                            </div>
                                            <div class="p-r-5 input-wrapper right">
                                                <div class='input-group date js-form-datetimepicker'>
                                                    {!! Form::text('banned_at', null,
                                                    ['class' => 'form-control', 'id' => 'banned_at', 'readonly' => 'readonly']) !!}
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="js-send-invitation">
                                    <h3>Send invitation to join</h3> 
                                    <p>User already exist. Do you want to send invitation?</p>                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="javascript:;" class="btn default button-previous js-btn-back" style="display: none">
                                    <i class="fa fa-angle-left"></i> Back </a>
                                <a class="btn btn-outline green button-next js-continue js-btn-continue"> Continue
                                    <i class="fa fa-angle-right"></i>
                                </a>                                
                                <button type="submit" class="btn green button-submit js-btn-send" style="display: none"> Send <i class="fa fa-check"></i></button>
                                <button type="submit" class="btn green button-submit js-btn-submit" style="display: none"> Submit <i class="fa fa-check"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
			{{ Form::close() }}
        </div>
    </div>
@endsection
@section('page-script')
    <script src="{{ asset('js/admin/users.js') }}" type="text/javascript"></script>
@endsection