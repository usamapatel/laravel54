<div class="form-body">
    <div class="form-group">
        <label class="col-md-2 control-label">Name</label>
        <div class="col-md-9">
            {!! Form::text('name', $from=="edit" ? $permission->name : null,['class' => 'form-control']) !!}
        </div>
    </div>
</div>
<div class="form-actions">
    <div class="row">
        <div class="col-md-12 text-center">
            <button type="submit" class="btn green">Submit</button>
            <a class="btn red-sunglo" href="{{ route('permissions.index', ['domain' => app('request')->route()->parameter('company')]) }}">Cancel</a>
        </div>
    </div>
</div>