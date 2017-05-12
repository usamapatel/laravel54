<div class="form-body">
    <div class="form-row col-md-6 clearfix">
        <div class="form-col-1">
            <label class="label">Name </label>
        </div>
        <div class="p-r-5 input-wrapper right">
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
    <div class="">
        <div class="col-md-12">
            <button type="submit" class="uie-btn uie-btn-primary save-btn">Submit</button>
            <a class="uie-btn uie-secondary-btn reset-btn" href="{{ route('teams.index', ['domain' => app('request')->route()->parameter('company')]) }}">Cancel</a>
        </div>
    </div>
</div>