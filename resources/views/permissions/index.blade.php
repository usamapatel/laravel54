@extends('layouts.admin.default')

@section('page-content')
    <div class="row">
        <div class="col-md-12" id="permissionlist">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        Search
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
                                <div class="form-group">
                                    <label class="col-md-3 col-sm-12 control-label">Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Name" id="permission_name">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="pull-right">
                                    <button type="button" class="btn green" @click="searchPermissionData()">Search</button>
                                    <button type="button" class="btn btn-default" @click="clearForm('frmSearchData')">Clear</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="portlet light">
            
                <div class="portlet-title">
                    <div class="caption col-md-9">
                        <i class="icon-share font-dark hide"></i>
                        <span class="caption-subject font-dark bold uppercase">Permission List</span>
                    </div>
                    <div class="col-md-3">
                        <div class="btn-group pull-right">
                            <a class="btn sbold green" href="{{ route('permissions.create') }}"> Add New
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
                                    <th data-field="title" @click="sortBy('question')" :class="[sortKey != 'question' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Name</th>
                                    <th data-field="views" @click="sortBy('views')" :class="[sortKey != 'views' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Created at</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="" v-for="permission in permissionData">  
                                    <td>@{{ permission.name }}</td>
                                    <td>@{{ permission.created_at }}</td>                                    
                                    <td class="text-center">
                                        <a href="{{ url('admin/permissions') }}/@{{ permission.id }}/edit" class="btn btn-icon-only green">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#" data-confirm-msg="Are you sure you would like to delete this permission record?" data-delete-url="{{ url('admin/permissions') }}/@{{ permission.id }}" class="btn btn-icon-only red js-delete-button" data-toggle="modal" data-target="#delete_modal"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div v-if="permissionCount == 0" class="col-md-12">
                            <h4 class="block text-center">No record found</h4>
                        </div>
                        <div v-if="permissionCount > 0">
                            <div class="col-md-5 col-sm-12 dataTables_info table-pagination-info">
                                <pagination_component>
                                </pagination_component>
                            </div>
                            <div class="col-md-7 col-sm-12 dataTables_paginate">
                                <ul id="permission_pagination" class="pagination-sm pull-right">
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
    <script type="text/javascript" src="{{ asset('js/admin/common.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/permission.js') }}"></script>
@endsection
