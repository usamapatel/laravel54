 <ul class="sub-menu">
	@foreach ($menu_item as $item)
		<li class="nav-item">
		    <a href="{{ url($item['url']) }}" class="nav-link {{ (isset($item['children']) && count($item['children'])) ? 'nav-toggle' : '' }}">
		    	<i class="fa {{ $item['icon'] }}"></i>
		        <span class="title">{{ $item['name'] }}</span>
		        <span class="selected"></span>
		        @if(isset($item['children']) && count($item['children']))
		        	<span class="arrow"></span>
		        @endif
		    </a>
		    @if(isset($item['children']) && count($item['children']))
            	@include('elements.admin.submenu', ['menu_item' => $item['children']])
        	@endif
		</li>		
    @endforeach
</ul> 