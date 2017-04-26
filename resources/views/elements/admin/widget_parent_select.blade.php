@foreach ($widgets as $item)
 	<option value="{{ $item['id'] }}" {{ ($from=='edit' && $item['id'] == $widget->parent_id) ? 'selected=selected ' : '' }}>
 		{{ '[' . $loop->iteration . '] ' . $item['name'] }}
 	</option>
	@if(isset($item['children']) && count($item['children']))
	     @include('elements.admin.widget_parent_select', ['widgets' => $item['children']])
	@endif 
@endforeach