@section('page-style')
    <link href="{{ asset('plugins/datatables/datatables.min.css') }}" type="text/css"></link>
@endsection

@extends('layouts.admin.default')

@section('page-content')
    <div class="row">
        <div class="col-md-12" id="teamlist">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        Search
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="expand" data-original-title="" title=""> </a>
                        <a href="javascript:;" class="reload" data-original-title="" title="" aria-describedby="tooltip73982" @click="reloadData();"> </a>
                    </div>
                </div>
                <div class="portlet-body flip-scroll" style="display: none">
                    <div class="form-horizontal" id="frmSearchData">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-md-3 col-sm-12 control-label">Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Name" id="module_name">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="pull-right">
                                    <button type="button" class="btn green" @click="searchModuleData()">Search</button>
                                    <button type="button" class="btn btn-default" @click="clearForm('frmSearchData')">Clear</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="portlet light">
                @include('flash::message')
                <div class="portlet-title">
                    <div class="caption col-md-9">
                        <i class="icon-share font-dark hide"></i>
                        <span class="caption-subject font-dark bold uppercase">Team List</span>
                    </div>
                    <div class="col-md-3">
                        <div class="btn-group pull-right">
                            <a class="btn sbold green" href="{{ route('teams.create', ['domain' => app('request')->route()->parameter('company')]) }}"> Add New
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div>
                        <table class="table table-striped table-bordered table-hover order-column datatable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Current Team</th>
                                    <th>Created at</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($teams as $team)
                                    <tr>
                                        <td>{{$team->name}}</td>
                                        <td>
                                            @if(auth()->user()->isOwnerOfTeam($team))
                                                <span class="label label-success">{{ __("Owner") }}</span>
                                            @else
                                                <span class="label label-primary">{{ __("Member") }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(is_null(auth()->user()->currentTeam) || auth()->user()->currentTeam->getKey() !== $team->getKey())
                                                <a href="{{ route('teams.switch', ['domain' => app('request')->route()->parameter('company'), 'id' => $team]) }}" class="btn btn-sm btn-default green">
                                                    <i class="fa fa-sign-in"></i> Switch
                                                </a>
                                            @else
                                                <span class="label label-default">{{ __("Current team") }}</span>
                                            @endif
                                        </td>
                                        <td>{{ Carbon\Carbon::parse($team->created_at)->format('d-m-Y h:i:s') }}</td>
                                        <td>
                                            <a href="{{route('teams.members.show', ['domain' => app('request')->route()->parameter('company'), 'id' => $team] )}}" class="btn btn-icon-only green">
                                                <i class="fa fa-users"></i>
                                            </a>

                                            @if(auth()->user()->isOwnerOfTeam($team))
                                                <a href="{{route('teams.edit', ['domain' => app('request')->route()->parameter('company'), 'id' => $team] )}}" class="btn btn-icon-only green">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <a href="#" data-confirm-msg="Are you sure you would like to delete this team record?" data-delete-url="{{route('teams.destroy', ['domain' => app('request')->route()->parameter('company'), 'id' => $team])}}" class="btn btn-icon-only red js-delete-button" data-toggle="modal" data-target="#delete_modal"><i class="fa fa-trash"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
    <script type="text/javascript" src="{{ asset('js/admin/teams.js') }}"></script>
    <script src="{{ asset('plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
@endsection
