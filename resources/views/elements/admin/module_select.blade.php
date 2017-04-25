@foreach ($mod as $item)
	<option value="{{ $item['id'] }}" {{ ($from=='edit' && $item['id'] == $module->parent_id) ? 'selected=selected ' : '' }}>{{ '[' . $loop->iteration . '] ' . $item['name'] }}</option>
	@if(isset($item['children']) && count($item['children']))
    	@include('elements.admin.module_select', ['mod' => $item['children']])
	@endif	
@endforeach