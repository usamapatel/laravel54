<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Storage;
use View;

class RolesController extends Controller
{
    public $title;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->title = 'Role';
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
     * Initialize variables.
     *
     * @return void
     */
    public function init()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('roles.index');
    }

    /**
     * Get role data.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRoleData()
    {
        $request = $this->request->all();
        $roles = DB::table('roles')->select('*', DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y %H:%i:%s") as "created_datetime"'));

        $sortby = 'roles.id';
        $sorttype = 'desc';

        if (isset($request['sortby'])) {
            $sortby = $request['sortby'];
            $sorttype = $request['sorttype'];
        }

        $roles->orderBy($sortby, $sorttype);

        if (isset($request['name']) && trim($request['name']) !== '') {
            $roles->where('roles.name', 'like', '%'.$request['name'].'%');
        }

        $rolesList = [];

        if (!array_key_exists('pagination', $request)) {
            $roles = $roles->paginate($request['pagination_length']);
            $rolesList = $roles;
        } else {
            $rolesList['total'] = $roles->count();
            $rolesList['data'] = $roles->get();
        }

        $response = $rolesList;

        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();

        return view('roles.create', compact('permissions'));
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
        $this->init();
        $role = new Role();
        $role->name = $request->name;
        $role->save();

        $role->givePermissionTo($request->permissions);
        flash()->success(config('config-variables.flash_messages.dataSaved'));

        return redirect()->route('roles.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $rolesId
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($rolesId)
    {
        $role = Role::find($rolesId);
        $permissions = Permission::all();
        $assignedPermissions = $role->permissions->pluck('name')->all();

        return view('roles.edit', compact('role', 'permissions', 'assignedPermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     * @param mixed                    $rolesId
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $rolesId)
    {
        $this->init();
        $role = Role::findOrFail($rolesId);
        $role->name = $request->name;
        $role->save();
        $role->syncPermissions();
        $role->givePermissionTo($request->permissions);
        flash()->success(config('config-variables.flash_messages.dataSaved'));

        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int   $id
     * @param mixed $rolesId
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($rolesId)
    {
        $message = config('config-variables.flash_messages.dataDeleted');
        $type = 'success';
        if (!Role::where('id', $rolesId)->delete()) {
            $message = config('config-variables.flash_messages.dataNotDeleted');
            $type = 'danger';
        }
        flash()->message($message, $type);

        return redirect()->route('roles.index');
    }
}
