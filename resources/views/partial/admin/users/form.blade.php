<div class="form-body">
    <div class="form-group">
        <label class="col-md-3 control-label">Name </label>
        <div class="col-md-9">
            {!! Form::text('name', $from=="edit" ? $users->name : null,['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Email</label>
        <div class="col-md-9">
            {!! Form::email('email', $from=="edit" ? $users->email : null,['class' => 'form-control']) !!}       
        </div>
    </div>
     <div class="form-group">
        <label class="control-label col-md-3">Created at</label>
        <div class="col-md-9">
            <div class='input-group date js-form-datetimepicker'>
                {!! Form::text('banned_at', $from=="edit" ? Carbon\Carbon::parse($users->banned_at)->format('d/m/Y h:i A') : null,
                ['class' => 'form-control', 'id' => 'banned_at', 'readonly' => 'readonly']) !!}
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <div class="row">
            <div class="col-md-offset-3 col-md-9">
                <button type="submit" class="btn green">Submit</button>
                <a class="btn default" href="{{ route('users.index') }}">Cancel</a>
            </div>
        </div>
    </div>
</div>    