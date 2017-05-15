@extends('layouts.admin.default')

@section('page-style')

@endsection
@section('page-content')

{!! Form::open(['route' => ['groups.update', 'domain' => app('request')->route()->parameter('company'), 'id' => $role->id], 'class' => 'js-frm-edit-group form-inline row module-edit','method' => 'PUT', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}

    @include('partial.admin.groups.form',['from'=>'edit'])
    
{{ Form::close() }}
@endsection

@section('page-script')

<script type="text/javascript">
    $(document).ready(function(){
        $('.module_header_toggle').click(function(){
            $(this).next().toggle();
        });
    });
</script>
<script type="text/javascript" src="{{ asset('js/admin/groups.js') }}"></script>
@endsection