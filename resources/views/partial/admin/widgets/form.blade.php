<div class="form-body">

    <div class="form-group">
        <label class="col-md-3 control-label">Controller</label>
        <div class="col-md-9">
            <select class="form-control select2-hide-search-box" id="parent_id" name="widget_controller">
                <option value="">Select</option>
                @if (count($allWidgetControllers) > 0)
                    @foreach ($allWidgetControllers as $controller)
                            @if(isset($controller['children']) && count($controller['children']))
                                <option value="{{ $controller['id'] }}" {{ ($from=='edit' && $controller['id'] == $widget->widget_type_id) ? 'selected=selected ' : '' }} {{ $controller['type'] == 'Module'? 'disabled' : '' }}>{{ $controller['name'] }}</option>
                                @include('elements.admin.widget_select_controller', ['mod' => $controller['children'], 'prefix' => '&nbsp;&nbsp;&nbsp;'])
                            @else
                                <option value="{{ $controller['id'] }}" {{ ($from=='edit' && $controller['id'] == $widget->widget_type_id) ? 'selected=selected ' : '' }}>{{ $controller['name'] }}</option>
                            @endif
                    @endforeach
                @endif
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Widget Type</label>
        <div class="col-md-9">
            <select class="form-control select2-hide-search-box" id="parent_id" name="widget_type">
                <option value="">Select</option>
                @if (count($WidgetTypes) > 0)
                    @foreach ($WidgetTypes as $type)
                        @if(isset($type['children']) && count($type['children']))
                            <option value="{{ $type['id'] }}" {{ ($from=='edit' && $type['id'] == $widget->widget_type_id) ? 'selected=selected ' : '' }}>{{ $type['name'] }}</option>
                            @include('elements.admin.widget_type_select', ['type' => $type['children']])
                        @else
                            <option value="{{ $type['id'] }}" {{ ($from=='edit' && $type['id'] == $widget->widget_type_id) ? 'selected=selected ' : '' }}>{{ $type['name'] }}</option>
                        @endif
                    @endforeach
                @endif
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Widget Parent</label>
        <div class="col-md-9">
            <select class="form-control select2-hide-search-box" id="parent_id" name="widget_parent">
                <option value="">Select</option>                
                @if (count($WidgetTree) > 0)
                    @foreach ($WidgetTree as $wt)
                        @if(isset($wt['children']) && count($wt['children']))
                            <option value="{{ $wt['id'] }}" {{ ($from=='edit' && $wt['id'] == $widget->parent_id) ? 'selected=selected ' : '' }}>{{ $wt['name'] }}</option>
                            @include('elements.admin.widget_parent_select', ['widgets' => $wt['children']])
                        @else
                            <option value="{{ $wt['id'] }}" {{ ($from=='edit' && $wt['id'] == $widget->parent_id) ? 'selected=selected ' : '' }}>{{ $wt['name'] }}</option>
                        @endif
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Widget Icon</label>
        <div class="col-md-9">
            {!! Form::text('widget_icon', $from=="edit" ? $widget->icon : null, ['class' => 'form-control js-icon-picker', 'readonly' => 'readonly']) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Widget Name</label>
        <div class="col-md-9">
            {!! Form::text('widget_name', $from=="edit" ? $widget->name : null,['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-2">Description</label>
        <div class="col-md-9">
            {{ Form::textarea('description', $from=="edit" ? $widget->description : null, ['class' => 'ckeditor form-control', 'id' =>'description', 'rows' => '6']) }}
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Widget Width</label>
        <div class="col-md-9">
            {!! Form::select('widget_width', config('config-variables.widget_widths'), $from=="edit" ? $widget->width : null, array('class' =>'form-control select2-allow-clear select2-hide-search-box', 'placeholder' =>'Select')) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-2">Is active?</label>
        <div class="col-md-9">
            {!! Form::checkbox('status', 1, $from=="edit" ? $widget->status : true, ['class' => 'make-switch', 'data-on-text' => 'Yes', 'data-off-text' => 'No']) !!}
        </div>
    </div>
</div>
<div class="form-actions">
    <div class="row">
        <div class="col-md-12 text-center">
            <button type="submit" class="btn green">Submit</button>
            <a class="btn red-sunglo" href="{{ route('widgets.index', ['domain' => app('request')->route()->parameter('company')]) }}">Cancel</a>
        </div>
    </div>
</div>