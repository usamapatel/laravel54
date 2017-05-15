<div class="form-body">
    <div class="form-group">
        <label class="col-md-2 control-label">Name</label>
        <div class="col-md-9">
            {!! Form::text('name', $from=="edit" ? $role->name : null,['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Permissions</label>
        <div class="col-md-9">
            <div class="row">
                @foreach($permissions as $permission)
                    <div class="col-md-3">
                        {{ Form::checkbox('permissions[]', $permission->name, $from == "edit" ? (in_array($permission->name, $assignedPermissions)) : null ) }} {{ ucfirst(trans($permission->name)) }}<br>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="form-actions">
    <div class="row">
        <div class="col-md-12 text-center">
            <button type="submit" class="btn green">Submit</button>
            <a class="btn red-sunglo" href="{{ route('roles.index', ['domain' => app('request')->route()->parameter('company')]) }}">Cancel</a>
        </div>
    </div>
</div>