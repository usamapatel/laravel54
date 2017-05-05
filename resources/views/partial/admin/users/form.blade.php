<div class="form-body">
    <div class="form-group">
        <label class="col-md-3 control-label">First Name </label>
        <div class="col-md-9">
            {!! Form::text('first_name', $from=="edit" ? $user->person->first_name : null,['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">Last Name </label>
        <div class="col-md-9">
            {!! Form::text('last_name', $from=="edit" ? $user->person->last_name : null,['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">Username </label>
        <div class="col-md-9">
            {!! Form::text('username', $from=="edit" ? $user->username : null,['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Email</label>
        <div class="col-md-9">
            {!! Form::email('email', $from=="edit" ? $user->email : null,['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Created at</label>
        <div class="col-md-9">
            <div class='input-group date js-form-datetimepicker'>
                {!! Form::text('banned_at', $from=="edit" ? Carbon\Carbon::parse($user->banned_at)->format('d/m/Y h:i A') : null,
                ['class' => 'form-control', 'id' => 'banned_at', 'readonly' => 'readonly']) !!}
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">Roles</label>
        <div class="col-md-9">
            <div class="row">
                @foreach($roles as $role)
                    <div class="col-md-3">
                        {{ Form::checkbox('roles[]', $role->name, $from == "edit" ? $user->hasRole($role->name) : null ) }} {{ $role->display_name }}<br>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="form-actions">
        <div class="row">
            <div class="col-md-offset-3 col-md-9">
                <button type="submit" class="btn green">Submit</button>
                <a class="btn default" href="{{ route('users.index', ['domain' => app('request')->route()->parameter('company')]) }}">Cancel</a>
            </div>
        </div>
    </div>
</div>    