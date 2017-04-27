@extends('layouts.admin.default')

@section('page-content')
    <div class="portlet light">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-share font-dark hide"></i>
                <span class="caption-subject font-dark bold uppercase">{{ __("Add Team") }}</span>
            </div>
        </div>
        <div class="portlet-body form">
            {!! Form::open(['route' => ['teams.store', 'domain' => app('request')->route()->parameter('company')], 'class' => 'js-frm-create-team form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}
                @include('partial.admin.teams.form', ['from'=>'add'])
            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('page-script')
    <script src="{{ asset('js/admin/teams.js') }}" type="text/javascript"></script>
@endsection
