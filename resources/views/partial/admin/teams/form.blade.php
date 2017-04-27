<div class="form-body">
    <div class="form-group">
        <label class="col-md-3 control-label">Name</label>
        <div class="col-md-9">
            {!! Form::text('name', $from=="edit" ? $team->name : null,['class' => 'form-control']) !!}

            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="form-actions">
    <div class="row">
        <div class="col-md-offset-3 col-md-9">
            <button type="submit" class="btn green">Submit</button>
            <a class="btn default" href="{{ route('teams.index', ['domain' => app('request')->route()->parameter('company')]) }}">Cancel</a>
        </div>
    </div>
</div>