@foreach ($group_item as $item)
<div class="col-lg-4">
    <div class="portlet light box-layout " id="moduleBlock-2">
        <div class="portlet-body">
            <div class="mt-element-list">
                <div class="mt-list-head list-todo green-haze font-white inner-title-group module_header_toggle">
                    <div class="list-head-title-container">
                        <h4 class="list-title">{{ $item['name'] }} 
                        <div class="md-checkbox pull-right">
                            <label class="mt-checkbox mt-checkbox-outline">
                                <input type="checkbox">
                                <span></span>
                            </label>
                        </div>
                        </h4>
                    </div>
                    <div class="tools dash-widget" id="moduleTool-3">
                        <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                    </div>
                </div>
                                
                <div class="mt-list-container list-todo" role="tablist" aria-multiselectable="true" id="moduleDiv-2" display:none""="">
                    <ul>
                        <li class="mt-list-item">
                            <div class="list-todo-icon bg-white">
                                <i class="icon-layers"></i>
                            </div>
                			@if(isset($item['children']) && count($item['children']))                            
	                            <div class="list-todo-item grey-steel">
	                                <a class="list-toggle-container" data-toggle="collapse" data-parent="#moduleDiv-5" onclick=" " href="#task-5" aria-expanded="false">
	                                    <div class="list-toggle done uppercase">
	                                        <div class="list-toggle-title font-blue-chambray  sbold">Dashboard </div>
	                                        <div class="badge badge-default pull-right bold"></div>
	                                    </div>
	                                </a>
	                                <div class="task-list panel-collapse collapse in" id="task-5">
	                                    <ul class="inner_list">
	                                        <li class="task-list-item done">
	                                           <ul class="list-group group-scroll">
	                                           @foreach ($item['children'] as $child) 
	                                                <li class="list-group-item">
	                                                    <div class="md-checkbox pull-left">
	                                                        <label class="mt-checkbox mt-checkbox-outline">
                                                                {!! Form::checkbox('groupItems[]', $child['id'], ($from=="edit" &&
                                                                 in_array($child['id'], $modules))  ? true : null) !!}
	                                                            <span></span>
	                                                        </label>
	                                                    </div> 
	                                                    {{ $child['name'] }} 
	                                                </li>
	                                                @endforeach                                                             
	                                            </ul>
	                                        </li>
	                                    </ul>
	                                </div>
	                            </div>
                        	@endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach