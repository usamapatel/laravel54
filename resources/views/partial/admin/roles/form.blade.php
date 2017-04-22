<div class="form-body">
    <div class="form-group">
        <label class="col-md-3 control-label">Name</label>
        <div class="col-md-9">
            {!! Form::text('name', $from=="edit" ? $role->name : null,['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">Permissions</label>
        @foreach($permissions as $permission)
            <div class="col-md-3">
                {{ Form::checkbox('permission[]', $permission->name, in_array($permission->name, $assignedPermissions) ) }} {{ ucfirst(trans($permission->name)) }}<br>
            </div>
        @endforeach
    </div>
</div>
<div class="form-actions">
    <div class="row">
        <div class="col-md-offset-3 col-md-9">
            <button type="submit" class="btn green">Submit</button>
            <a class="btn default" href="{{ route('roles.index') }}">Cancel</a>
        </div>
    </div>
</div>