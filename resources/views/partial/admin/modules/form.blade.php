<div class="form-body">
    <div class="form-row col-md-6 clearfix">
        <div class="form-col-1">
            <label class="label">Controller </label>
        </div>
        <div class="p-r-5 input-wrapper right">
            <select class="form-control select2-hide-search-box" id="parent_id" name="parent_id">
                <option value="">Select</option>
                @if (count($allModules) > 0)
                    @foreach ($allModules as $mod)
                        @if(isset($mod['children']) && count($mod['children']))
                            <option value="{{ $mod['id'] }}" {{ ($from=='edit' && $mod['id'] == $module->parent_id) ? 'selected=selected ' : '' }}>{{ $mod['name'] }}</option>
                            @include('elements.admin.module_select', ['mod' => $mod['children'], 'prefix' => '&nbsp;&nbsp;&nbsp;'])
                        @else
                            <option value="{{ $mod['id'] }}" {{ ($from=='edit' && $mod['id'] == $module->parent_id) ? 'selected=selected ' : '' }}>{{ $mod['name'] }}</option>
                        @endif
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="form-row col-md-6 clearfix">
        <div class="form-col-1">
            <label class="label">Module Name </label>
        </div>
        <div class="p-r-5 input-wrapper right">
            {!! Form::text('name', $from=="edit" ? $module->name : null, ['class' => 'form-control', 'id' => 'module_name']) !!}
        </div>
    </div>
    <div class="form-row col-md-6 clearfix">
        <div class="form-col-1">
            <label class="label">Description</label>
        </div>
        <div class="p-r-5 input-wrapper right">
            {{ Form::textarea('description', $from=="edit" ? $module->description : null, ['class' => 'ckeditor form-control', 'id' =>'description', 'rows' => '1']) }}
        </div>
    </div>
    <div class="form-row col-md-6 clearfix">
        <div class="form-col-1">
            <label class="label">Module URL</label>
        </div>
        <div class="p-r-5 input-wrapper right">
            {!! Form::text('url', $from=="edit" ? $module->url : null,['class' => 'form-control', 'id' => 'module_url', 'readonly' => 'readonly']) !!}
        </div>
    </div>
    <div class="form-row col-md-6 clearfix">
        <div class="form-col-1">
            <label class="label">Module Order</label>
        </div>
        <div class="p-r-5 input-wrapper right">
            {!! Form::text('order', $from=="edit" ? $module->order : null,['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-row col-md-6 clearfix">
        <div class="form-col-1">
            <label class="label">Module Icon</label>
        </div>
        <div class="p-r-5 input-wrapper right">
            {!! Form::text('icon', $from=="edit" ? $module->icon : null, ['class' => 'form-control js-icon-picker', 'readonly' => 'readonly']) !!}
        </div>
    </div>
    <div class="form-row col-md-6 clearfix">
        <div class="form-col-1">
            <label class="label">Module Type</label>
        </div>
        <div class="p-r-5 input-wrapper right">
            {!! Form::select('type', config('config-variables.module_types'), $from=="edit" ? $module->type : null, array('class' =>'form-control select2-hide-search-box', 'placeholder' =>'Select', 'id' => 'module_type')) !!}
        </div>
    </div>
    <div class="form-row col-md-6 clearfix">
        <div class="form-col-1">
            <label class="label">Is Active?</label>
        </div>
        <div class="p-r-5 input-wrapper right">
            {!! Form::checkbox('is_active', 1, $from=="edit" ? $module->is_active : true, ['class' => 'make-switch', 'data-on-text' => 'Yes', 'data-off-text' => 'No']) !!}
        </div>
    </div>
    <div class="form-row col-md-6 clearfix">
        <div class="form-col-1">
            <label class="label">Is Shown On Menu?</label>
        </div>
        <div class="p-r-5 input-wrapper right">
            {!! Form::checkbox('is_shown_on_menu', 1, $from=="edit" ? $module->is_shown_on_menu : true, ['class' => 'make-switch', 'data-on-text' => 'Yes', 'data-off-text' => 'No']) !!}
        </div>
    </div>
    <div class="form-row col-md-6 clearfix">
        <div class="form-col-1">
            <label class="label">Is Publicly Visible?</label>
        </div>
        <div class="p-r-5 input-wrapper right">
            {!! Form::checkbox('is_publicly_visible', 1, $from=="edit" ? $module->is_publicly_visible : true, ['class' => 'make-switch', 'data-on-text' => 'Yes', 'data-off-text' => 'No', 'id' => 'is_publicly_visible']) !!}
        </div>
    </div>
</div>
<div class="form-actions">
    <div class="">
        <div class="col-md-12">
            <button type="submit" class="uie-btn uie-btn-primary save-btn">Submit</button>
            <a class="uie-btn uie-secondary-btn reset-btn" href="{{ route('modules.index', ['domain' => app('request')->route()->parameter('company')]) }}">Cancel</a>
        </div>
    </div>
</div>