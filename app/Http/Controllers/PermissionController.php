<?php

namespace App\Http\Controllers;

use DB;
use View;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->title = 'Permission';
        $this->request = $request;
        View::share('title', $this->title);
        parent::__construct();
    }

    /**
     * Destory/Unset object variables.
     *
     * @return void
     */
    public function __destruct()
    {
        unset($this->title);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('permissions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Get permission data.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPermissionData()
    {
        $request = $this->request->all();
        $permissions = DB::table('permissions')->select('*', DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y %H:%i:%s") as "created_datetime"'));

        $sortby = 'permission.id';
        $sorttype = 'desc';
        if (isset($request['sortby'])) {
            $sortby = $request['sortby'];
            $sorttype = $request['sorttype'];
        }

        $permissions->orderBy($sortby, $sorttype);

        // $permissions->where('permissions.deleted_at', '=', null);
        if (isset($request['name']) && trim($request['name']) !== '') {
            $permissions->where('permissions.name', 'like', '%'.$request['name'].'%');
        }

        $permissionsList = [];

        $permissionsList['total'] = $permissions->count();
        $permissionsList['data'] = $permissions->get();

        if (! array_key_exists('pagination', $request)) {
            $permissions = $permissions->paginate($request['pagination_length']);
            $permissionsList = $permissions;
        }

        $response = $permissionsList;

        return $response;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permission = new Permission();
        $permission->name = $request->name;
        $permission->save();

        flash()->success(config('config-variables.flash_messages.dataSaved'));

        return redirect()->route('permissions.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int   $id
     * @param mixed $permissionId
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($permissionId)
    {
        $permission = Permission::find($permissionId);

        return view('permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     * @param mixed                    $permissionId
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $permissionId)
    {
        $permission = Permission::findOrFail($permissionId);
        $permission->name = $request->name;
        $permission->save();
        flash()->success(config('config-variables.flash_messages.dataSaved'));

        return redirect()->route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int   $permissionId
     * @param mixed $permissionId
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($permissionId)
    {
        $message = config('config-variables.flash_messages.dataDeleted');
        $type = 'success';
        if (! Permission::where('id', $permissionId)->delete()) {
            $message = config('config-variables.flash_messages.dataNotDeleted');
            $type = 'danger';
        }
        flash()->message($message, $type);

        return redirect()->route('permissions.index');
    }
}
