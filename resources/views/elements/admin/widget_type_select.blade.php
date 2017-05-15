@foreach ($type as $item)
 	<option value="{{ $item['id'] }}" {{ ($from=='edit' && $item['id'] == $widget->widget_type_id) ? 'selected=selected ' : '' }}>
 		{{ '[' . $loop->iteration . '] ' . $item['name'] }}
 	</option>
	@if(isset($item['children']) && count($item['children']))
	     @include('elements.admin.widget_type_select', ['type' => $item['children']])
	@endif 
@endforeach