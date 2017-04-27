@foreach ($mod as $item)
	<option value="{{ $item['id'] }}" {{ ($from=='edit' && $item['id'] == $module->parent_id) ? 'selected=selected ' : '' }}>{{ $prefix . '[' . $loop->iteration . '] ' . $item['name'] }}</option>
	@if(isset($item['children']) && count($item['children']))
    	@include('elements.admin.module_select', ['mod' => $item['children'], 'prefix' => $prefix . '&nbsp;&nbsp;&nbsp;'])
	@endif	
@endforeach