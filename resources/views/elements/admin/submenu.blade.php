<ul class="sub-menu">
	@foreach ($menu_item as $item)
		<li class="nav-item start ">
		    <a href="{{ url($item['url']) }}" class="nav-link ">
		    	<i class="fa {{ $item['icon'] }}"></i>
		        <span class="title">{{ $item['name'] }}</span>
		    </a>
		    @if(isset($item['children']) && count($item['children']))
            	@include('elements.admin.submenu', ['menu_item' => $item['children']])
        	@endif
		</li>		
    @endforeach
</ul>