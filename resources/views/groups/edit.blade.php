@extends('layouts.admin.default')

@section('page-style')

@endsection
@section('page-content')
	<div class="portlet light">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-share font-dark hide"></i>
                <span class="caption-subject font-dark bold uppercase"> 
                <i class="fa fa-gear fa-lg" aria-hidden="true">&nbsp;</i> EDIT GROUP </span>
            </div>
        </div>
        <div class="portlet-body form">
       		<form class="form-inline row module-edit">
                <div class="form-group col-md-6">
                    <label class="col-md-3" for="">Group Name:</label>
                    <input type="email" class="form-control col-md-6" placeholder="Sales e-mail" style="width: 350px;"> 
                </div> 
                <div class="form-group col-md-6">
                    <label class="col-md-3" ">Active Status:</label>
                    <div class="mt-radio-inline col-md-5">
                        <label class="mt-radio">
                            <input type="radio" name="optionsRadios" id="optionsRadios4" value="option1" checked=""> Yes
                            <span></span>
                        </label>
                        <label class="mt-radio">
                            <input type="radio" name="optionsRadios" id="optionsRadios5" value="option2"> No
                            <span></span>
                        </label>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="portlet light box-layout ribb-box modul_list">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-share font-dark hide"></i>
                <span class="caption-subject font-dark bold uppercase">
                <i class="fa fa-gear fa-lg" aria-hidden="true">&nbsp;</i> ASSIGN ACCESS WIDGETS</span>
            </div>
            <div class="tools">
                <a href="" class="collapse" data-original-title="" title=""> </a>
            </div>
        </div>
        <div id="sortable">
            <div class="portlet light box-layout group-clear grop-box-1">
                <div class="mt-element-ribbon portlet-title add-form">
                    <div class="ribbon ribbon-shadow ribbon-color-black uppercase title-group-color"><div class="ribbon-sub ribbon-clip title-group-color"></div>Organization</div>
                    <!--<div class="tools dash-widget">
                        <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                    </div>-->
                </div>
                <div class="portlet-body form">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="portlet light box-layout " id="moduleBlock-2">
                                <div class="portlet-body">
                                    <div class="mt-element-list">
                                        <div class="mt-list-head list-todo green-haze font-white inner-title-group module_header_toggle">
                                            <div class="list-head-title-container">
                                                <h4 class="list-title">Lead Manager 
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
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget  1 
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget  2
                                                                        </li> 
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget  3 
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget  4 
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget  5 
                                                                        </li><li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget  6 
                                                                        </li>
                                                                                     
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                                 <li class="mt-list-item">
                                                    <div class="list-todo-icon bg-white">
                                                        <i class="icon-layers"></i>
                                                    </div>
                                                    <div class="list-todo-item grey-steel">
                                                        <a class="list-toggle-container" data-toggle="collapse" data-parent="#moduleDiv-6" onclick=" " href="#task-6" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title font-blue-chambray  sbold">List </div>
                                                                <div class="badge badge-default pull-right bold"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse in" id="task-6">
                                                            <ul class="inner_list">
                                                                <li class="task-list-item done">
                                                                   <ul class="list-group group-scroll">
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget  1 
                                                                        </li>        
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-icon bg-white">
                                                        <i class="icon-layers"></i>
                                                    </div>
                                                    <div class="list-todo-item grey-steel">
                                                        <a class="list-toggle-container" data-toggle="collapse" data-parent="#moduleDiv-37" onclick=" " href="#task-37" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title font-blue-chambray  sbold">Batches </div>
                                                                <div class="badge badge-default pull-right bold"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse in" id="task-37">
                                                            <ul class="inner_list">
                                                                <li class="task-list-item done">
                                                                   <ul class="list-group group-scroll">
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget  1 
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget  2
                                                                        </li> 
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget  3 
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget  4 
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget  5 
                                                                        </li><li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget  6 
                                                                        </li>
                                                                                     
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="portlet light box-layout " id="moduleBlock-3">
                                <div class="portlet-body">
                                    <div class="mt-element-list">
                                        <div class="mt-list-head list-todo green-haze font-white inner-title-group module_header_toggle ">
                                            <div class="list-head-title-container">
                                                <h4 class="list-title">Call Center Manager 
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
                                        
                                        <div class="mt-list-container list-todo" role="tablist" aria-multiselectable="true" id="moduleDiv-3" display:none""="">
                                            <ul>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-icon bg-white">
                                                        <i class="icon-layers"></i>
                                                    </div>
                                                    <div class="list-todo-item grey-steel">
                                                        <a class="list-toggle-container" data-toggle="collapse" data-parent="#moduleDiv-16" onclick=" " href="#task-16" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title font-blue-chambray  sbold">Dashboard
                                                                </div>
                                                                <div class="badge badge-default pull-right bold"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse in" id="task-16">
                                                            <ul class="inner_list">
                                                                <li class="task-list-item done">
                                                                   <ul class="list-group group-scroll">
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget  1 
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget  2
                                                                        </li> 
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget  3 
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget  4 
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget  5 
                                                                        </li>        
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-icon bg-white">
                                                        <i class="icon-layers"></i>
                                                    </div>
                                                    <div class="list-todo-item grey-steel">
                                                        <a class="list-toggle-container" data-toggle="collapse" data-parent="#moduleDiv-7" onclick=" " href="#task-7" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title font-blue-chambray  sbold">List </div>
                                                                <div class="badge badge-default pull-right bold"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse in" id="task-7">
                                                            <ul class="inner_list">
                                                                <li class="task-list-item done">
                                                                   <ul class="list-group group-scroll">
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget  1 
                                                                        </li>        
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-icon bg-white">
                                                        <i class="icon-layers"></i>
                                                    </div>
                                                    <div class="list-todo-item grey-steel">
                                                        <a class="list-toggle-container" data-toggle="collapse" data-parent="#moduleDiv-8" onclick=" " href="#task-8" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title font-blue-chambray  sbold">ADD </div>
                                                                <div class="badge badge-default pull-right bold"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse in" id="task-8">
                                                            <ul class="inner_list">
                                                                <li class="task-list-item done">
                                                                   <ul class="list-group group-scroll">
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget  1 
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget  2
                                                                        </li> 
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-icon bg-white">
                                                        <i class="icon-layers"></i>
                                                    </div>
                                                    <div class="list-todo-item grey-steel">
                                                        <a class="list-toggle-container" data-toggle="collapse" data-parent="#moduleDiv-9" onclick=" " href="#task-9" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title font-blue-chambray  sbold">Call History </div>
                                                                <div class="badge badge-default pull-right bold"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse in" id="task-9">
                                                            <ul class="inner_list">
                                                                <li class="task-list-item done">
                                                                   <ul class="list-group group-scroll">
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget  1 
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget  2
                                                                        </li> 
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-icon bg-white">
                                                        <i class="icon-layers"></i>
                                                    </div>
                                                    <div class="list-todo-item grey-steel">
                                                        <a class="list-toggle-container" data-toggle="collapse" data-parent="#moduleDiv-10" onclick=" " href="#task-10" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title font-blue-chambray  sbold">Quick Lead </div>
                                                                <div class="badge badge-default pull-right bold"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse in" id="task-10">
                                                            <ul class="inner_list">
                                                                <li class="task-list-item done">
                                                                   <ul class="list-group group-scroll">
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget  1 
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget  2
                                                                        </li> 
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-icon bg-white">
                                                        <i class="icon-layers"></i>
                                                    </div>
                                                    <div class="list-todo-item grey-steel">
                                                        <a class="list-toggle-container" data-toggle="collapse" data-parent="#moduleDiv-11" onclick=" " href="#task-11" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title font-blue-chambray  sbold">Batches </div>
                                                                <div class="badge badge-default pull-right bold"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse in" id="task-11">
                                                            <ul class="inner_list">
                                                                <li class="task-list-item done">
                                                                    <ul class="list-group group-scroll">
                                                                        <span class="widgetCommingsoon text-danger">
                                                                            <center>Widget Not Available</center>
                                                                        </span>          
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-icon bg-white">
                                                        <i class="icon-layers"></i>
                                                    </div>
                                                    <div class="list-todo-item grey-steel">
                                                        <a class="list-toggle-container" data-toggle="collapse" data-parent="#moduleDiv-12" onclick=" " href="#task-12" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title font-blue-chambray  sbold">Agenda manager </div>
                                                                <div class="badge badge-default pull-right bold"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse in" id="task-12">
                                                            <ul class="inner_list">
                                                                <li class="task-list-item done">
                                                                    <ul class="list-group group-scroll">
                                                                        <span class="widgetCommingsoon text-danger">
                                                                            <center>Widget Not Available</center>
                                                                        </span>          
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="portlet light box-layout " id="moduleBlock-4">
                                <div class="portlet-body">
                                    <div class="mt-element-list">
                                        <div class="mt-list-head list-todo green-haze font-white inner-title-group module_header_toggle">
                                            <div class="list-head-title-container">
                                                <h4 class="list-title">Resource Manager
                                                <div class="md-checkbox pull-right">
                                                    <label class="mt-checkbox mt-checkbox-outline">
                                                        <input type="checkbox">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                </h4>
                                            </div>
                                            <div class="tools dash-widget" id="moduleTool-4">
                                                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                            </div>
                                        </div>
                                        
                                        <div class="mt-list-container list-todo" role="tablist" aria-multiselectable="true" id="moduleDiv-3" display:none""="">
                                            <ul>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-icon bg-white">
                                                        <i class="icon-layers"></i>
                                                    </div>
                                                    <div class="list-todo-item grey-steel">
                                                        <a class="list-toggle-container" data-toggle="collapse" data-parent="#moduleDiv-15" onclick=" " href="#task-15" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title font-blue-chambray  sbold">Add </div>
                                                                <div class="badge badge-default pull-right bold"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse in" id="task-15">
                                                            <ul class="inner_list">
                                                                <li class="task-list-item done">
                                                                   <ul class="list-group group-scroll">
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget  1 
                                                                        </li>        
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-icon bg-white">
                                                        <i class="icon-layers"></i>
                                                    </div>
                                                    <div class="list-todo-item grey-steel">
                                                        <a class="list-toggle-container" data-toggle="collapse" data-parent="#moduleDiv-16" onclick=" " href="#task-16" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title font-blue-chambray  sbold">List </div>
                                                                <div class="badge badge-default pull-right bold"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse in" id="task-16">
                                                            <ul class="inner_list">
                                                                <li class="task-list-item done">
                                                                   <ul class="list-group group-scroll">
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget 2 
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="portlet light box-layout " id="moduleBlock-5">
                                <div class="portlet-body">
                                    <div class="mt-element-list">
                                        <div class="mt-list-head list-todo green-haze font-white inner-title-group module_header_toggle">
                                            <div class="list-head-title-container">
                                                <h4 class="list-title">Boss of Field Agent
                                                <div class="md-checkbox pull-right">
                                                    <label class="mt-checkbox mt-checkbox-outline">
                                                        <input type="checkbox">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                </h4>
                                            </div>
                                            <div class="tools dash-widget" id="moduleTool-6">
                                                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                            </div>
                                        </div>
                                        
                                        <div class="mt-list-container list-todo" role="tablist" aria-multiselectable="true" id="moduleDiv-6" display:none""="">
                                            <ul>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-icon bg-white">
                                                        <i class="icon-layers"></i>
                                                    </div>
                                                    <div class="list-todo-item grey-steel">
                                                        <a class="list-toggle-container" data-toggle="collapse" data-parent="#moduleDiv-17" onclick=" " href="#task-17" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title font-blue-chambray  sbold">List </div>
                                                                <div class="badge badge-default pull-right bold"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse in" id="task-17">
                                                            <ul class="inner_list">
                                                                <li class="task-list-item done">
                                                                   <ul class="list-group group-scroll">
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget 1 
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget 2 
                                                                        </li>        
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-icon bg-white">
                                                        <i class="icon-layers"></i>
                                                    </div>
                                                    <div class="list-todo-item grey-steel">
                                                        <a class="list-toggle-container" data-toggle="collapse" data-parent="#moduleDiv-18" onclick=" " href="#task-18" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title font-blue-chambray  sbold">Add </div>
                                                                <div class="badge badge-default pull-right bold"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse in" id="task-18">
                                                            <ul class="inner_list">
                                                                <li class="task-list-item done">
                                                                   <ul class="list-group group-scroll">
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget 1 
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-icon bg-white">
                                                        <i class="icon-layers"></i>
                                                    </div>
                                                    <div class="list-todo-item grey-steel">
                                                        <a class="list-toggle-container" data-toggle="collapse" data-parent="#moduleDiv-19" onclick=" " href="#task-19" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title font-blue-chambray  sbold">Add </div>
                                                                <div class="badge badge-default pull-right bold"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse in" id="task-19">
                                                            <ul class="inner_list">
                                                                <li class="task-list-item done">
                                                                   <ul class="list-group group-scroll">
                                                                        <span class="widgetCommingsoon text-danger">
                                                                            <center>Widget Not Available</center>
                                                                        </span>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="portlet light box-layout group-clear grop-box-1">
                <div class="mt-element-ribbon portlet-title add-form">
                    <div class="ribbon ribbon-shadow ribbon-color-black uppercase title-group-color"><div class="ribbon-sub ribbon-clip title-group-color"></div>configuration</div>
                </div>
                <div class="portlet-body form">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="portlet light box-layout " id="configuration_module">
                                <div class="portlet-body">
                                    <div class="mt-element-list">
                                        <div class="mt-list-head list-todo green-haze font-white inner-title-group module_header_toggle">
                                            <div class="list-head-title-container">
                                                <h4 class="list-title">Module Manage 
                                                <div class="md-checkbox pull-right">
                                                    <label class="mt-checkbox mt-checkbox-outline">
                                                        <input type="checkbox">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                </h4>
                                            </div>
                                            <div class="tools dash-widget">
                                                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                            </div>
                                        </div>
                                        
                                        <div class="mt-list-container list-todo" role="tablist" aria-multiselectable="true" id="module_2" display:none""="">
                                            <ul>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-icon bg-white">
                                                        <i class="icon-layers"></i>
                                                    </div>
                                                    <div class="list-todo-item grey-steel">
                                                        <a class="list-toggle-container" data-toggle="collapse" data-parent="#moduleDiv-21" onclick=" " href="#module-21" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title font-blue-chambray  sbold">List </div>
                                                                <div class="badge badge-default pull-right bold"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse in" id="module-21">
                                                            <ul class="inner_list">
                                                                <span class="widgetCommingsoon text-danger"><center>Widget Not Available</center></span>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                                 <li class="mt-list-item">
                                                    <div class="list-todo-icon bg-white">
                                                        <i class="icon-layers"></i>
                                                    </div>
                                                    <div class="list-todo-item grey-steel">
                                                        <a class="list-toggle-container" data-toggle="collapse" data-parent="#moduleDiv-22" onclick=" " href="#module-22" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title font-blue-chambray  sbold">Add </div>
                                                                <div class="badge badge-default pull-right bold"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse in" id="module-22">
                                                            <ul class="inner_list">
                                                                <li class="task-list-item done">
                                                                   <ul class="list-group group-scroll">
                                                                        <span class="widgetCommingsoon text-danger"><center>Widget Not Available</center></span>      
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="portlet light box-layout " id="moduleBlock-3">
                                <div class="portlet-body">
                                    <div class="mt-element-list">
                                        <div class="mt-list-head list-todo green-haze font-white inner-title-group module_header_toggle ">
                                            <div class="list-head-title-container">
                                                <h4 class="list-title">Widgets Manager
                                                <div class="md-checkbox pull-right">
                                                    <label class="mt-checkbox mt-checkbox-outline">
                                                        <input type="checkbox">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                </h4>
                                            </div>
                                            <div class="tools dash-widget">
                                                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                            </div>
                                        </div>
                                        
                                        <div class="mt-list-container list-todo" role="tablist" aria-multiselectable="true" id="moduleDiv-3" display:none""="">
                                            <ul>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-icon bg-white">
                                                        <i class="icon-layers"></i>
                                                    </div>
                                                    <div class="list-todo-item grey-steel">
                                                        <a class="list-toggle-container" data-toggle="collapse" data-parent="#moduleDiv-23" onclick=" " href="#task-23" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title font-blue-chambray  sbold">List
                                                                </div>
                                                                <div class="badge badge-default pull-right bold"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse in" id="task-23">
                                                            <ul class="inner_list">
                                                                <li class="task-list-item done">
                                                                   <ul class="list-group group-scroll">
                                                                        <span class="widgetCommingsoon text-danger"><center>Widget Not Available</center></span> 
                                                                   </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-icon bg-white">
                                                        <i class="icon-layers"></i>
                                                    </div>
                                                    <div class="list-todo-item grey-steel">
                                                        <a class="list-toggle-container" data-toggle="collapse" data-parent="#moduleDiv-24" onclick=" " href="#task-24" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title font-blue-chambray  sbold">Add </div>
                                                                <div class="badge badge-default pull-right bold"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse in" id="task-24">
                                                            <ul class="inner_list">
                                                                <li class="task-list-item done">
                                                                   <ul class="list-group group-scroll">
                                                                        <span class="widgetCommingsoon text-danger"><center>Widget Not Available</center></span>      
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="portlet light box-layout " id="moduleBlock-4">
                                <div class="portlet-body">
                                    <div class="mt-element-list">
                                        <div class="mt-list-head list-todo green-haze font-white inner-title-group module_header_toggle">
                                            <div class="list-head-title-container">
                                                <h4 class="list-title">Group Manager
                                                <div class="md-checkbox pull-right">
                                                    <label class="mt-checkbox mt-checkbox-outline">
                                                        <input type="checkbox">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                </h4>
                                            </div>
                                            <div class="tools dash-widget" id="moduleTool-4">
                                                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                            </div>
                                        </div>
                                        
                                        <div class="mt-list-container list-todo" role="tablist" aria-multiselectable="true" id="moduleDiv-3" display:none""="">
                                            <ul>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-icon bg-white">
                                                        <i class="icon-layers"></i>
                                                    </div>
                                                    <div class="list-todo-item grey-steel">
                                                        <a class="list-toggle-container" data-toggle="collapse" data-parent="#moduleDiv-25" onclick=" " href="#task-25" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title font-blue-chambray  sbold">List </div>
                                                                <div class="badge badge-default pull-right bold"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse in" id="task-25">
                                                            <ul class="inner_list">
                                                                <li class="task-list-item done">
                                                                   <ul class="list-group group-scroll">
                                                                        <span class="widgetCommingsoon text-danger"><center>Widget Not Available</center></span>       
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-icon bg-white">
                                                        <i class="icon-layers"></i>
                                                    </div>
                                                    <div class="list-todo-item grey-steel">
                                                        <a class="list-toggle-container" data-toggle="collapse" data-parent="#moduleDiv-26" onclick=" " href="#task-26" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title font-blue-chambray  sbold">add </div>
                                                                <div class="badge badge-default pull-right bold"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse in" id="task-26">
                                                            <ul class="inner_list">
                                                                <li class="task-list-item done">
                                                                   <ul class="list-group group-scroll">
                                                                        <span class="widgetCommingsoon text-danger"><center>Widget Not Available</center></span>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="portlet light box-layout " id="moduleBlock-5">
                                <div class="portlet-body">
                                    <div class="mt-element-list">
                                        <div class="mt-list-head list-todo green-haze font-white inner-title-group module_header_toggle">
                                            <div class="list-head-title-container">
                                                <h4 class="list-title">EmailTemplate
                                                <div class="md-checkbox pull-right">
                                                    <label class="mt-checkbox mt-checkbox-outline">
                                                        <input type="checkbox">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                </h4>
                                            </div>
                                            <div class="tools dash-widget" id="moduleTool-6">
                                                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                            </div>
                                        </div>
                                        
                                        <div class="mt-list-container list-todo" role="tablist" aria-multiselectable="true" id="moduleDiv-6" display:none""="">
                                            <ul>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-icon bg-white">
                                                        <i class="icon-layers"></i>
                                                    </div>
                                                    <div class="list-todo-item grey-steel">
                                                        <a class="list-toggle-container" data-toggle="collapse" data-parent="#moduleDiv-27" onclick=" " href="#task-27" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title font-blue-chambray  sbold">Add </div>
                                                                <div class="badge badge-default pull-right bold"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse in" id="task-27">
                                                            <ul class="inner_list">
                                                                <li class="task-list-item done">
                                                                   <ul class="list-group group-scroll">
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget 1 
                                                                        </li>    
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-icon bg-white">
                                                        <i class="icon-layers"></i>
                                                    </div>
                                                    <div class="list-todo-item grey-steel">
                                                        <a class="list-toggle-container" data-toggle="collapse" data-parent="#moduleDiv-28" onclick=" " href="#task-28" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title font-blue-chambray  sbold">list </div>
                                                                <div class="badge badge-default pull-right bold"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse in" id="task-28">
                                                            <ul class="inner_list">
                                                                <li class="task-list-item done">
                                                                   <ul class="list-group group-scroll">
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget 1 
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget 1 
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-icon bg-white">
                                                        <i class="icon-layers"></i>
                                                    </div>
                                                    <div class="list-todo-item grey-steel">
                                                        <a class="list-toggle-container" data-toggle="collapse" data-parent="#moduleDiv-29" onclick=" " href="#task-29" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title font-blue-chambray  sbold">Add </div>
                                                                <div class="badge badge-default pull-right bold"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse in" id="task-29">
                                                            <ul class="inner_list">
                                                                <li class="task-list-item done">
                                                                   <ul class="list-group group-scroll">
                                                                        <span class="widgetCommingsoon text-danger">
                                                                            <center>Widget Not Available</center>
                                                                        </span>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="portlet light box-layout group-clear grop-box-1">
                <div class="mt-element-ribbon portlet-title add-form">
                    <div class="ribbon ribbon-shadow ribbon-color-black uppercase title-group-color"><div class="ribbon-sub ribbon-clip title-group-color"></div>DASHBOARD</div>
                </div>
                <div class="portlet-body form">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="portlet light box-layout " id="configuration_module">
                                <div class="portlet-body">
                                    <div class="mt-element-list">
                                        <div class="mt-list-head list-todo green-haze font-white inner-title-group module_header_toggle">
                                            <div class="list-head-title-container">
                                                <h4 class="list-title">Dashboard Manager
                                                <div class="md-checkbox pull-right">
                                                    <label class="mt-checkbox mt-checkbox-outline">
                                                        <input type="checkbox">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                </h4>
                                            </div>
                                            <div class="tools dash-widget">
                                                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                            </div>
                                        </div>
                                        
                                        <div class="mt-list-container list-todo" role="tablist" aria-multiselectable="true" id="" display:none""="">
                                            <ul>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-icon bg-white">
                                                        <i class="icon-layers"></i>
                                                    </div>
                                                    <div class="list-todo-item grey-steel">
                                                        <a class="list-toggle-container" data-toggle="collapse" data-parent="#moduleDiv-31" onclick=" " href="#task-31" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title font-blue-chambray  sbold">Dashboard Manager </div>
                                                                <div class="badge badge-default pull-right bold"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse in" id="task-31">
                                                            <ul class="inner_list">
                                                                <li class="task-list-item done">
                                                                   <ul class="list-group group-scroll">
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget  1 
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget  2
                                                                        </li> 
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget  3 
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget  4 
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget  5 
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget  6 
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget  7 
                                                                        </li>        
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget 8 
                                                                        </li>  
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="portlet light box-layout group-clear grop-box-1">
                <div class="mt-element-ribbon portlet-title add-form">
                    <div class="ribbon ribbon-shadow ribbon-color-black uppercase title-group-color"><div class="ribbon-sub ribbon-clip title-group-color"></div>MARKETING</div>
                </div>
                <div class="portlet-body form">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="portlet light box-layout " id="configuration_module">
                                <div class="portlet-body">
                                    <div class="mt-element-list">
                                        <div class="mt-list-head list-todo green-haze font-white inner-title-group module_header_toggle">
                                            <div class="list-head-title-container">
                                                <h4 class="list-title">Medium 
                                                <div class="md-checkbox pull-right">
                                                    <label class="mt-checkbox mt-checkbox-outline">
                                                        <input type="checkbox">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                </h4>
                                            </div>
                                            <div class="tools dash-widget">
                                                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                            </div>
                                        </div>
                                        
                                        <div class="mt-list-container list-todo" role="tablist" aria-multiselectable="true" id="module_2" display:none""="">
                                            <ul>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-icon bg-white">
                                                        <i class="icon-layers"></i>
                                                    </div>
                                                    <div class="list-todo-item grey-steel">
                                                        <a class="list-toggle-container" data-toggle="collapse" data-parent="#moduleDiv-41" onclick=" " href="#task-41" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title font-blue-chambray  sbold">List </div>
                                                                <div class="badge badge-default pull-right bold"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse in" id="task-41">
                                                            <ul class="inner_list">
                                                                <li class="task-list-item done">
                                                                   <ul class="list-group group-scroll">
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget  1 
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-icon bg-white">
                                                        <i class="icon-layers"></i>
                                                    </div>
                                                    <div class="list-todo-item grey-steel">
                                                        <a class="list-toggle-container" data-toggle="collapse" data-parent="#moduleDiv-42" onclick=" " href="#task-42" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title font-blue-chambray  sbold">Add </div>
                                                                <div class="badge badge-default pull-right bold"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse in" id="task-42">
                                                            <ul class="inner_list">
                                                                <li class="task-list-item done">
                                                                   <ul class="list-group group-scroll">
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget 1
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget 2
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="portlet light box-layout " id="configuration_module">
                                <div class="portlet-body">
                                    <div class="mt-element-list">
                                        <div class="mt-list-head list-todo green-haze font-white inner-title-group module_header_toggle">
                                            <div class="list-head-title-container">
                                                <h4 class="list-title">Source 
                                                <div class="md-checkbox pull-right">
                                                    <label class="mt-checkbox mt-checkbox-outline">
                                                        <input type="checkbox">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                </h4>
                                            </div>
                                            <div class="tools dash-widget">
                                                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                            </div>
                                        </div>
                                        
                                        <div class="mt-list-container list-todo" role="tablist" aria-multiselectable="true" id="module_2" display:none""="">
                                            <ul>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-icon bg-white">
                                                        <i class="icon-layers"></i>
                                                    </div>
                                                    <div class="list-todo-item grey-steel">
                                                        <a class="list-toggle-container" data-toggle="collapse" data-parent="#moduleDiv-41" onclick=" " href="#task-43" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title font-blue-chambray  sbold">List </div>
                                                                <div class="badge badge-default pull-right bold"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse in" id="task-43">
                                                            <ul class="inner_list">
                                                                <li class="task-list-item done">
                                                                   <ul class="list-group group-scroll">
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget  1 
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-icon bg-white">
                                                        <i class="icon-layers"></i>
                                                    </div>
                                                    <div class="list-todo-item grey-steel">
                                                        <a class="list-toggle-container" data-toggle="collapse" data-parent="#moduleDiv-42" onclick=" " href="#task-44" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title font-blue-chambray  sbold">Add </div>
                                                                <div class="badge badge-default pull-right bold"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse in" id="task-44">
                                                            <ul class="inner_list">
                                                                <li class="task-list-item done">
                                                                   <ul class="list-group group-scroll">
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget 1
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget 2
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="portlet light box-layout " id="configuration_module">
                                <div class="portlet-body">
                                    <div class="mt-element-list">
                                        <div class="mt-list-head list-todo green-haze font-white inner-title-group module_header_toggle">
                                            <div class="list-head-title-container">
                                                <h4 class="list-title">Investment  
                                                <div class="md-checkbox pull-right">
                                                    <label class="mt-checkbox mt-checkbox-outline">
                                                        <input type="checkbox">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                </h4>
                                            </div>
                                            <div class="tools dash-widget">
                                                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                            </div>
                                        </div>
                                        
                                        <div class="mt-list-container list-todo" role="tablist" aria-multiselectable="true" id="module_2" display:none""="">
                                            <ul>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-icon bg-white">
                                                        <i class="icon-layers"></i>
                                                    </div>
                                                    <div class="list-todo-item grey-steel">
                                                        <a class="list-toggle-container" data-toggle="collapse" data-parent="#moduleDiv-45" onclick=" " href="#task-45" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title font-blue-chambray  sbold">List </div>
                                                                <div class="badge badge-default pull-right bold"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse in" id="task-45">
                                                            <ul class="inner_list">
                                                                <li class="task-list-item done">
                                                                   <ul class="list-group group-scroll">
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget  1 
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-icon bg-white">
                                                        <i class="icon-layers"></i>
                                                    </div>
                                                    <div class="list-todo-item grey-steel">
                                                        <a class="list-toggle-container" data-toggle="collapse" data-parent="#moduleDiv-46" onclick=" " href="#task-46" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title font-blue-chambray  sbold">Add </div>
                                                                <div class="badge badge-default pull-right bold"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse in" id="task-46">
                                                            <ul class="inner_list">
                                                                <li class="task-list-item done">
                                                                   <ul class="list-group group-scroll">
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget 1
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget 2
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-icon bg-white">
                                                        <i class="icon-layers"></i>
                                                    </div>
                                                    <div class="list-todo-item grey-steel">
                                                        <a class="list-toggle-container" data-toggle="collapse" data-parent="#moduleDiv-47" onclick=" " href="#task-47" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title font-blue-chambray  sbold">Investment Leads Details </div>
                                                                <div class="badge badge-default pull-right bold"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse in" id="task-47">
                                                            <ul class="inner_list">
                                                                <li class="task-list-item done">
                                                                   <ul class="list-group group-scroll">
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget 1
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="portlet light box-layout group-clear grop-box-1">
                <div class="mt-element-ribbon portlet-title add-form">
                    <div class="ribbon ribbon-shadow ribbon-color-black uppercase title-group-color"><div class="ribbon-sub ribbon-clip title-group-color"></div>FIELDAGENT</div>
                </div>
                <div class="portlet-body form">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="portlet light box-layout " id="configuration_module">
                                <div class="portlet-body">
                                    <div class="mt-element-list">
                                        <div class="mt-list-head list-todo green-haze font-white inner-title-group module_header_toggle">
                                            <div class="list-head-title-container">
                                                <h4 class="list-title">Sevices
                                                <div class="md-checkbox pull-right">
                                                    <label class="mt-checkbox mt-checkbox-outline">
                                                        <input type="checkbox">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                </h4>
                                            </div>
                                            <div class="tools dash-widget">
                                                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                            </div>
                                        </div>
                                        
                                        <div class="mt-list-container list-todo" role="tablist" aria-multiselectable="true" id="module_2" display:none""="">
                                            <ul>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-icon bg-white">
                                                        <i class="icon-layers"></i>
                                                    </div>
                                                    <div class="list-todo-item grey-steel">
                                                        <a class="list-toggle-container" data-toggle="collapse" data-parent="#moduleDiv-51" onclick=" " href="#task-51" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title font-blue-chambray  sbold">List </div>
                                                                <div class="badge badge-default pull-right bold"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse in" id="task-51">
                                                            <ul class="inner_list">
                                                                <li class="task-list-item done">
                                                                   <ul class="list-group group-scroll">
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget  1 
                                                                        </li>  
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="portlet light box-layout group-clear grop-box-1">
                <div class="mt-element-ribbon portlet-title add-form">
                    <div class="ribbon ribbon-shadow ribbon-color-black uppercase title-group-color"><div class="ribbon-sub ribbon-clip title-group-color"></div>PRODUCTS</div>
                </div>
                <div class="portlet-body form">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="portlet light box-layout " id="configuration_module">
                                <div class="portlet-body">
                                    <div class="mt-element-list">
                                        <div class="mt-list-head list-todo green-haze font-white inner-title-group module_header_toggle">
                                            <div class="list-head-title-container">
                                                <h4 class="list-title">Accessories 
                                                <div class="md-checkbox pull-right">
                                                    <label class="mt-checkbox mt-checkbox-outline">
                                                        <input type="checkbox">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                </h4>
                                            </div>
                                            <div class="tools dash-widget">
                                                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                            </div>
                                        </div>
                                        
                                        <div class="mt-list-container list-todo" role="tablist" aria-multiselectable="true" id="module_2" display:none""="">
                                            <ul>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-icon bg-white">
                                                        <i class="icon-layers"></i>
                                                    </div>
                                                    <div class="list-todo-item grey-steel">
                                                        <a class="list-toggle-container" data-toggle="collapse" data-parent="#moduleDiv-61" onclick=" " href="#task-61" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title font-blue-chambray  sbold">List </div>
                                                                <div class="badge badge-default pull-right bold"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse in" id="task-61">
                                                            <ul class="inner_list">
                                                                <li class="task-list-item done">
                                                                   <ul class="list-group group-scroll">
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget  1 
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-icon bg-white">
                                                        <i class="icon-layers"></i>
                                                    </div>
                                                    <div class="list-todo-item grey-steel">
                                                        <a class="list-toggle-container" data-toggle="collapse" data-parent="#moduleDiv-62" onclick=" " href="#task-62" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title font-blue-chambray  sbold">Add </div>
                                                                <div class="badge badge-default pull-right bold"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse in" id="task-62">
                                                            <ul class="inner_list">
                                                                <li class="task-list-item done">
                                                                   <ul class="list-group group-scroll">
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget 1
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget 2
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="portlet light box-layout " id="configuration_module">
                                <div class="portlet-body">
                                    <div class="mt-element-list">
                                        <div class="mt-list-head list-todo green-haze font-white inner-title-group module_header_toggle">
                                            <div class="list-head-title-container">
                                                <h4 class="list-title">Supliers 
                                                <div class="md-checkbox pull-right">
                                                    <label class="mt-checkbox mt-checkbox-outline">
                                                        <input type="checkbox">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                </h4>
                                            </div>
                                            <div class="tools dash-widget">
                                                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                            </div>
                                        </div>
                                        
                                        <div class="mt-list-container list-todo" role="tablist" aria-multiselectable="true" id="module_2" display:none""="">
                                            <ul>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-icon bg-white">
                                                        <i class="icon-layers"></i>
                                                    </div>
                                                    <div class="list-todo-item grey-steel">
                                                        <a class="list-toggle-container" data-toggle="collapse" data-parent="#moduleDiv-63" onclick=" " href="#task-63" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title font-blue-chambray  sbold">List </div>
                                                                <div class="badge badge-default pull-right bold"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse in" id="task-63">
                                                            <ul class="inner_list">
                                                                <li class="task-list-item done">
                                                                   <ul class="list-group group-scroll">
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget  1 
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-icon bg-white">
                                                        <i class="icon-layers"></i>
                                                    </div>
                                                    <div class="list-todo-item grey-steel">
                                                        <a class="list-toggle-container" data-toggle="collapse" data-parent="#moduleDiv-64" onclick=" " href="#task-64" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title font-blue-chambray  sbold">Add </div>
                                                                <div class="badge badge-default pull-right bold"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse in" id="task-64">
                                                            <ul class="inner_list">
                                                                <li class="task-list-item done">
                                                                   <ul class="list-group group-scroll">
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget 1
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget 2
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="portlet light box-layout " id="configuration_module">
                                <div class="portlet-body">
                                    <div class="mt-element-list">
                                        <div class="mt-list-head list-todo green-haze font-white inner-title-group module_header_toggle">
                                            <div class="list-head-title-container">
                                                <h4 class="list-title">Categories  
                                                <div class="md-checkbox pull-right">
                                                    <label class="mt-checkbox mt-checkbox-outline">
                                                        <input type="checkbox">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                </h4>
                                            </div>
                                            <div class="tools dash-widget">
                                                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                            </div>
                                        </div>
                                        
                                        <div class="mt-list-container list-todo" role="tablist" aria-multiselectable="true" id="module_2" display:none""="">
                                            <ul>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-icon bg-white">
                                                        <i class="icon-layers"></i>
                                                    </div>
                                                    <div class="list-todo-item grey-steel">
                                                        <a class="list-toggle-container" data-toggle="collapse" data-parent="#moduleDiv-65" onclick=" " href="#task-65" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title font-blue-chambray  sbold">List </div>
                                                                <div class="badge badge-default pull-right bold"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse in" id="task-65">
                                                            <ul class="inner_list">
                                                                <li class="task-list-item done">
                                                                   <ul class="list-group group-scroll">
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget  1 
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-icon bg-white">
                                                        <i class="icon-layers"></i>
                                                    </div>
                                                    <div class="list-todo-item grey-steel">
                                                        <a class="list-toggle-container" data-toggle="collapse" data-parent="#moduleDiv-66" onclick=" " href="#task-66" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title font-blue-chambray  sbold">Add </div>
                                                                <div class="badge badge-default pull-right bold"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse in" id="task-66">
                                                            <ul class="inner_list">
                                                                <li class="task-list-item done">
                                                                   <ul class="list-group group-scroll">
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget 1
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <div class="md-checkbox pull-left">
                                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> 
                                                                            Widget 2
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row module_btn">
            <div class="text-center col-md-12 clearfix">
                <button type="button" class="btn green-haze">Save</button>
                <button type="button" class="btn red-sunglo">Reset</button>
                <br>
            </div>
        </div>
    </div>
@endsection
@section('page-script')

<script type="text/javascript">
    $(document).ready(function(){
        $('.module_header_toggle').click(function(){
            $(this).next().toggle();
        });
    });
</script>
@endsection