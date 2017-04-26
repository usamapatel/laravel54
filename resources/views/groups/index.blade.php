@extends('layouts.admin.default')

@section('page-content')
    <div class="row">
        <div class="col-md-12" id="grouplist">
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
                                        <input type="text" class="form-control" placeholder="Name" id="group_name">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="pull-right">
                                    <button type="button" class="btn green" @click="searchGroupData()">Search</button>
                                    <button type="button" class="btn btn-default" @click="clearForm('frmSearchData')">Clear</button>
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
                        <i class="icon-share font-dark hide"></i>
                        <span class="caption-subject font-dark bold uppercase">Group List</span>
                    </div>
                    <div class="col-md-3">
                        <div class="btn-group pull-right">
                            <a class="btn sbold green" href="{{ route('groups.create') }}"> Add New
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
                                    <th data-field="name" @click="sortBy('name')" :class="[sortKey != 'name' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Group Name</th>
                                    <th data-field="status" @click="sortBy('status')" :class="[sortKey != 'status' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Status</th>
                                    <th data-field="created_datetime" @click="sortBy('created_datetime')" :class="[sortKey != 'created_datetime' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Created at</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="" v-for="group in groupData"> 
                                    <td>@{{ group.name }}</td>
                                    <td>@{{ group.status==1 ? 'Activated' : 'Inactive' }}</td>
                                    <td>@{{ group.created_datetime }}</td>
                                    <td class="text-center">
                                        <a href="{{ url('admin/groups') }}/@{{ group.id }}/edit" class="btn btn-icon-only green">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#" data-confirm-msg="Are you sure you would like to delete this group record?" data-delete-url="{{ url('admin/groups') }}/@{{ group.id }}" class="btn btn-icon-only red js-delete-button" data-toggle="modal" data-target="#delete_modal"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div v-if="groupCount == 0" class="col-md-12">
                            <h4 class="block text-center">No record found</h4>
                        </div>
                        <div v-if="groupCount > 0">
                            <div class="col-md-5 col-sm-12 dataTables_info table-pagination-info">
                                <pagination_component>
                                </pagination_component>
                            </div>
                            <div class="col-md-7 col-sm-12 dataTables_paginate">
                                <ul id="group_pagination" class="pagination-sm pull-right">
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
    <script type="text/javascript" src="{{ asset('js/admin/groups.js') }}"></script>
@endsection
