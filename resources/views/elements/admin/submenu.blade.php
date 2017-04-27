<ul class="sub-menu">
	@foreach ($menu_item as $item)
		<li class="nav-item start active open">
		    <a href="{{ $item['url'] }}" class="nav-link ">
		    	<!-- <i class="fa {{ $item['icon'] }}"></i> -->
		        <span class="title">{{ $item['name'] }}</span>
		        <span class="selected"></span>
		    </a>
		    @if(isset($item['children']) && count($item['children']))
            	@include('elements.admin.submenu', ['menu_item' => $item['children']])
        	@endif
		</li>		
    @endforeach
</ul>