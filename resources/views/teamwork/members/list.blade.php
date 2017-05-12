@extends('layouts.admin.default')

@section('page-content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light">
                @include('flash::message')
                <div class="portlet-title">
                    <div class="caption col-md-9">
                        <i class="icon-share font-dark hide"></i>
                        <span class="caption-subject font-dark bold uppercase">Members of team "{{ $team->name }}"</span>
                    </div>
                    <div class="col-md-3">
                        <div class="btn-group pull-right">
                            <a class="btn sbold green" href="{{ route('teams.index', ['domain' => app('request')->route()->parameter('company')]) }}"> Back
                                <i class="fa fa-arrow-left"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div>
                        <table class="table table-striped table-bordered table-hover order-column">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @foreach($team->users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>
                                        @if(auth()->user()->isOwnerOfTeam($team))
                                            @if(auth()->user()->getKey() !== $user->getKey())
                                                <a href="#" data-confirm-msg="Are you sure you would like to delete this member record?" data-delete-url="{{route('teams.members.destroy', ['domain' => app('request')->route()->parameter('company'), 'id' => $team, 'user_id' => $user])}}" class="btn btn-icon-only red js-delete-button" data-toggle="modal" data-target="#delete_modal"><i class="fa fa-trash"></i></a>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>

            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption col-md-9">
                        <i class="icon-share font-dark hide"></i>
                        <span class="caption-subject font-dark bold uppercase">Pending invitations</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover order-column">
                        <thead>
                        <tr>
                            <th>E-Mail</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        @foreach($team->invites AS $invite)
                            <tr>
                                <td>{{$invite->email}}</td>
                                <td>
                                    <a href="{{ route('teams.members.resend_invite', ['domain' => app('request')->route()->parameter('company'), 'invite_id' => $invite]) }}" class="btn btn-sm green">
                                        <i class="fa fa-envelope-o"></i> Resend invite
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>

            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption col-md-9">
                        <i class="icon-share font-dark hide"></i>
                        <span class="caption-subject font-dark bold uppercase">Invite to team "{{$team->name}}"</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <form class="form-horizontal js-frm-invite-member" method="post" action="{{route('teams.members.invite', ['domain' => app('request')->route()->parameter('company'), 'id' => $team])}}">
                        {!! csrf_field() !!}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary green">
                                    <i class="fa fa-btn fa-envelope-o"></i> Invite to Team
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
    <script src="{{ asset('js/admin/teams.js') }}" type="text/javascript"></script>
@endsection
