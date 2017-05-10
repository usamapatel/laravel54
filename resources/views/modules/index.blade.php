@extends('layouts.admin.default')

@section('page-content')
    <div class="row">
        <div class="col-md-12" id="modulelist">
            <div class="portlet box white">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">Search</span>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="expand" data-original-title="" title=""> </a>
                        <a href="javascript:;" class="reload" data-original-title="" title="" aria-describedby="tooltip73982" @click="reloadData();"> </a>
                    </div>
                </div>
                <div class="portlet-body flip-scroll" style="display: none">
                    <div class="form-horizontal" id="frmSearchData">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-row clearfix">
                                    <div class="form-col-1">
                                        <label class="label">Name </label>
                                    </div>
                                    <div class="p-r-5 input-wrapper right">
                                        <input type="text" class="form-control" placeholder="Name" id="module_name">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="pull-right">
                                    <button type="button" class="btn uie-btn uie-btn-primary" @click="searchModuleData()">Search</button>
                                    <button type="button" class="uie-btn uie-secondary-btn" @click="clearForm('frmSearchData')">Clear</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="portlet light">
                @include('flash::message')
                <div class="portlet-title">
                    <div class="caption col-md-9">
                        <i class="fa fa-table"></i>
                        <span class="caption-subject bold uppercase font-dark">Module List</span>
                    </div>
                    <div class="col-md-3">
                        <div class="btn-group pull-right">
                            <a class="btn sbold border-btn" href="{{ route('modules.create', ['domain' => app('request')->route()->parameter('company')]) }}"> Add New
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
               <div class="portlet-body">
                    <div>
                        <table class="table table-striped table-bordered table-hover order-column" v-cloak>
                            <thead>
                                <tr>
                                    <th data-field="name" @click="sortBy('name')" :class="[sortKey != 'name' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Name</th>
                                    <th data-field="url" @click="sortBy('url')" :class="[sortKey != 'url' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">URL</th>
                                    <th data-field="order" @click="sortBy('order')" :class="[sortKey != 'order' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Order</th>
                                    <th data-field="is_active" @click="sortBy('is_active')" :class="[sortKey != 'is_active' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Status</th>
                                    <th data-field="is_shown_on_menu" @click="sortBy('is_shown_on_menu')" :class="[sortKey != 'is_shown_on_menu' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Show on menu</th>
                                    <th data-field="created_datetime" @click="sortBy('created_datetime')" :class="[sortKey != 'created_datetime' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Created at</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="" v-for="module in moduleData">  
                                    <td>@{{ module.name }}</td>
                                    <td>@{{ module.url }}</td>
                                    <td>@{{ module.order }}</td>
                                    <td>@{{ module.is_active == 1 ? 'Active' : 'Inactive' }}</td>
                                    <td>@{{ module.is_shown_on_menu == 1 ? 'Yes' : 'No' }}</td>
                                    <td>@{{ module.created_datetime }}</td>                                 
                                    <td class="text-center table_icon">
                                        <a href="{{ url('admin/modules') }}/@{{ module.id }}/edit" class="btn btn-icon-only">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#" data-confirm-msg="Are you sure you would like to delete this module record?" data-delete-url="{{ url('admin/modules') }}/@{{ module.id }}" class="btn btn-icon-only js-delete-button" data-toggle="modal" data-target="#delete_modal"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div v-if="moduleCount == 0" class="col-md-12">
                            <h4 class="block text-center">No record found</h4>
                        </div>
                        <div v-if="moduleCount > 0">
                            <div class="col-md-5 col-sm-12 dataTables_info table-pagination-info">
                                <pagination_component>
                                </pagination_component>
                            </div>
                            <div class="col-md-7 col-sm-12 dataTables_paginate">
                                <ul id="module_pagination" class="pagination-sm pull-right">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('page-script')
    <script type="text/javascript" src="{{ asset('js/admin/modules.js') }}"></script>
@endsection
