@extends('layouts.admin.default')
@section('page-content')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="row">
        <div class="col-md-12" id="userlist">
            <div class="portlet box white">
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
                                        <input type="text" class="form-control" placeholder="User Name" id="user_name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-md-3 col-sm-12 control-label">Email</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Email" id="user_email">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="pull-right">
                                    <button type="button" class="btn green" @click="searchUserData()">Search</button>
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
                    <div class="caption col-md-8">
                        <i class="fa fa-table"></i>
                        <span class="caption-subject bold uppercase font-dark">User List</span>
                    </div>
                    <div class="col-md-4">
                        <div class="btn-group pull-right">
                            <a class="btn sbold border-btn" href="{{ route('users.create', ['domain' => app('request')->route()->parameter('company')]) }}"> Add New
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
                                    <th data-field="people.first_name" @click="sortBy('people.first_name')" :class="[sortKey != 'people.first_name' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">First name</th>
                                    <th data-field="people.last_name" @click="sortBy('people.last_name')" :class="[sortKey != 'people.last_name' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Last name</th>
                                    <th data-field="email" @click="sortBy('email')" :class="[sortKey != 'email' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Email</th> 
                                    <th data-field="created_datetime" @click="sortBy('created_datetime')" :class="[sortKey != 'created_datetime' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Created at</th>     
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="" v-for="user in userData">  
                                    <td>@{{ user.first_name }}</td>
                                    <td>@{{ user.last_name }}</td>
                                    <td>@{{ user.email }}</td>
                                    <td>@{{ user.created_datetime }}</td>
                                    <td class="text-center table_icon">
                                        <a href="{{url('admin/users')}}/@{{user.user_id}}/edit" class="btn btn-icon-only">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#" data-confirm-msg="Are you sure you would like to delete this tag record?" data-delete-url="{{ url('admin/users') }}/@{{ user.user_id }}"  class="btn btn-icon-only js-delete-button" data-toggle="modal" data-target="#delete_modal"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div v-if="userCount == 0" class="col-md-12">
                            <h4 class="block text-center">No record found</h4>
                        </div>
                        <div v-if="userCount > 0">
                            <div class="col-md-5 col-sm-12 dataTables_info table-pagination-info">
                                <pagination_component>
                                </pagination_component>
                            </div>
                            <div class="col-md-7 col-sm-12 dataTables_paginate">
                                <ul id="user_pagination" class="pagination-sm pull-right">
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
    <script type="text/javascript" src="{{ asset('js/admin/users.js') }}"></script>
@endsection
