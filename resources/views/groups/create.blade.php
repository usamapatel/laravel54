@extends('layouts.admin.default')

@section('page-style')

@endsection
@section('page-content')

{!! Form::open(['route' => ['groups.store', 'domain' => app('request')->route()->parameter('company')], 'class' => 'js-frm-create-group form-inline row module-edit', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}

    @include('partial.admin.groups.form',['from'=>'add'])
    
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