<div class="col-md-12">	
    <div class="portlet light">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-share font-dark hide"></i>
                <span class="caption-subject bold uppercase font-dark"> 
                <i class="fa fa-gear fa-lg" aria-hidden="true">&nbsp;</i> Create New Group  </span>
            </div>
        </div>
        <div class="portlet-body form">  
        <div class="row">
            <div class="form-group col-md-6">
                <label class="col-md-3 label" for="">Group Name:</label>                    
                {!! Form::text('group_name', $from=="edit" ? $role->display_name : null, ['class' => 'form-control col-md-6', 'style' => 'width: 350px;']) !!}
            </div> 
            <div class="form-group col-md-6">
                <label class="col-md-3 label">Active Status:</label>
                <div class="mt-radio-inline col-md-5" style="padding:0;">
                    {!! Form::checkbox('status', 1, $from=="edit" ? $role->status : null, ['class' => 'make-switch', 'data-on-text' => 'Yes', 'data-off-text' => 'No']) !!}
                </div>
            </div>
        </div>    
        </div>
    </div>
    
    <div class="portlet light box-layout ribb-box modul_list">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-share font-dark hide"></i>
                <span class="caption-subject bold uppercase font-dark">
                <i class="fa fa-gear fa-lg" aria-hidden="true">&nbsp;</i> Assign Access Widgets</span>
            </div>
            <div class="tools">
                <a href="" class="collapse" data-original-title="" title=""> </a>
            </div>
        </div>
        <div id="sortable">
            <div class="portlet light box-layout group-clear grop-box-1">
                @foreach($menuTree as $item)
                    <div class="mt-element-ribbon portlet-title add-form">
                        <div class="ribbon ribbon-shadow ribbon-color-black uppercase title-group-color"><div class="ribbon-sub ribbon-clip title-group-color"></div>{{ $item['name'] }}
                        </div>
                    </div>

                    <div class="portlet-body form">
                        <div class="row">
                        @if(isset($item['children']) && count($item['children']))                        
                             @include('elements.admin.group_menu', ['group_item' => $item['children']])
                        @endif               
                        </div>
                    </div>
                @endforeach  
            </div>
        </div>
        <div class="row module_btn">
            <div class="col-md-12 clearfix">
                <button type="submit" class="uie-btn uie-btn-primary save-btn">Save</button>
                <button type="button" class="uie-btn uie-secondary-btn reset-btn">Reset</button>
                <br>
            </div>
        </div>
    </div>
</div>