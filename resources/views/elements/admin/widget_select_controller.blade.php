@foreach ($mod as $item)
	<option value="{{ $item['id'] }}" {{ ($from=='edit' && $item['id'] == $widget->menu_item_id) ? 'selected=selected ' : '' }} {{ $item['type'] == 'Module'? 'disabled' : '' }}>{{ $prefix . '[' . $loop->iteration . '] ' . $item['name'] }}</option>
	@if(isset($item['children']) && count($item['children']))
    	@include('elements.admin.widget_select_controller', ['mod' => $item['children'], 'prefix' => $prefix . '&nbsp;&nbsp;&nbsp;'])
	@endif	
@endforeach