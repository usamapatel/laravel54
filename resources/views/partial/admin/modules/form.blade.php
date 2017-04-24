<div class="form-body">
    <div class="form-group">
        <label class="col-md-3 control-label">Controller</label>
        <div class="col-md-9">
            <select class="form-control select2-hide-search-box" id="parent_id" name="parent_id">
                <option value="">Select</option>
                @if (count($allModules) > 0)
                    @foreach ($allModules as $mod)
                        @if(isset($mod['children']) && count($mod['children']))
                            <option value="{{ $mod['id'] }}" {{ ($from=='edit' && $mod['id'] == $module->parent_id) ? 'selected=selected ' : '' }}>{{ $mod['name'] }}</option>
                            @include('elements.admin.module_select', ['mod' => $mod['children']])
                        @else
                            <option value="{{ $mod['id'] }}" {{ ($from=='edit' && $mod['id'] == $module->parent_id) ? 'selected=selected ' : '' }}>{{ $mod['name'] }}</option>
                        @endif
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">Module Name</label>
        <div class="col-md-9">
            {!! Form::text('name', $from=="edit" ? $module->name : null, ['class' => 'form-control', 'id' => 'module_name']) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Description</label>
        <div class="col-md-9">
            {{ Form::textarea('description', $from=="edit" ? $module->description : null, ['class' => 'ckeditor form-control', 'id' =>'description', 'rows' => '6']) }}
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">Module URL</label>
        <div class="col-md-9">
            {!! Form::text('url', $from=="edit" ? $module->url : null,['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">Module Order</label>
        <div class="col-md-9">
            {!! Form::text('order', $from=="edit" ? $module->order : null,['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">Module Icon</label>
        <div class="col-md-9">
            {!! Form::text('icon', $from=="edit" ? $module->icon : null, ['class' => 'form-control js-icon-picker', 'readonly' => 'readonly']) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">Module Type</label>
        <div class="col-md-9">
            {!! Form::select('type', config('config-variables.module_types'), $from=="edit" ? $module->type : null, array('class' =>'form-control select2-hide-search-box', 'placeholder' =>'Select', 'id' => 'module_type')) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">Is Active?</label>
        <div class="col-md-9">
            {!! Form::checkbox('is_active', 1, $from=="edit" ? $module->is_active : true, ['class' => 'make-switch', 'data-on-text' => 'Yes', 'data-off-text' => 'No']) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">Is Shown On Menu?</label>
        <div class="col-md-9">
            {!! Form::checkbox('is_shown_on_menu', 1, $from=="edit" ? $module->is_shown_on_menu : true, ['class' => 'make-switch', 'data-on-text' => 'Yes', 'data-off-text' => 'No']) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">Is Publicly Visible?</label>
        <div class="col-md-9">
            {!! Form::checkbox('is_publicly_visible', 1, $from=="edit" ? $module->is_publicly_visible : true, ['class' => 'make-switch', 'data-on-text' => 'Yes', 'data-off-text' => 'No', 'id' => 'is_publicly_visible']) !!}
        </div>
    </div>
</div>
<div class="form-actions">
    <div class="row">
        <div class="col-md-offset-3 col-md-9">
            <button type="submit" class="btn green">Submit</button>
            <a class="btn default" href="{{ route('permissions.index') }}">Cancel</a>
        </div>
    </div>
</div>