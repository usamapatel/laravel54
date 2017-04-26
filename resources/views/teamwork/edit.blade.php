@extends('layouts.admin.default')

@section('page-style')

@endsection

@section('page-content')
    <div class="portlet light">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-share font-dark hide"></i>
                <span class="caption-subject font-dark bold uppercase">Edit Team</span>
            </div>
        </div>
        <div class="portlet-body form">
            {!! Form::open(['route' => ['teams.update', 'domain' => app('request')->route()->parameter('company'), 'id' => $team], 'method' => 'PUT', 'class' => 'js-frm-edit-team form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}
                @include('partial.admin.teams.form',['from'=>'edit'])
            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('page-script')

@endsection