<div class="form-body">
    <div class="form-row col-md-6 clearfix">
        <div class="form-col-1">
            <label class="label">Email </label>
        </div>
        <div class="p-r-5 input-wrapper right">
            {!! Form::email('email', $from=="edit" ? $user->email : null,['class' => 'form-control', 'id' => 'email']) !!}
        </div>
    </div>
    <div class="form-row col-md-6 clearfix">
        <div class="form-col-1">
            <label class="label">Roles </label>
        </div>
        <div class="p-r-5 input-wrapper right">
            <div class="row">
                @foreach($roles as $role)
                    <div class="col-md-12">
                        {{ Form::checkbox('roles[]', $role->name, $from == "edit" ? $user->hasRole($role->name) : null ) }} {{ $role->display_name }}<br>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div>
        <div class="form-row col-md-6 clearfix">
            <div class="form-col-1">
                <label class="label">Name </label>
            </div>
            <div class="p-r-5 input-wrapper right">
                {!! Form::text('first_name', $from=="edit" ? $user->person->first_name : null,['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-row col-md-6 clearfix">
            <div class="form-col-1">
                <label class="label">Last Name </label>
            </div>
            <div class="p-r-5 input-wrapper right">
                {!! Form::text('last_name', $from=="edit" ? $user->person->last_name : null,['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-row col-md-6 clearfix">
            <div class="form-col-1">
                <label class="label">Username </label>
            </div>
            <div class="p-r-5 input-wrapper right">
                {!! Form::text('username', $from=="edit" ? $user->username : null,['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-row col-md-6 clearfix">
            <div class="form-col-1">
                <label class="label">Created at </label>
            </div>
            <div class="p-r-5 input-wrapper right">
                <div class='input-group date js-form-datetimepicker'>
                    {!! Form::text('banned_at', $from=="edit" ? Carbon\Carbon::parse($user->banned_at)->format('d/m/Y h:i A') : null,
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