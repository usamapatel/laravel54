<?php

namespace App\Http\Controllers;

use DB;
use View;
use Session;
use Storage;
use JavaScript;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

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
        $this->request= $request;
        View::share ( 'title', $this->title );
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
     * Get role data
     *
     * @return \Illuminate\Http\Response
     */
    public function getRoleData() {
        $request = $this->request->all();
        $roles=DB::table('roles')->select("*", DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y %H:%i:%s") as "created_datetime"'));

        if(isset($request['sortby'])) {
            $sortby = $request['sortby'];
            $sorttype = $request['sorttype'];
        } else {
            $sortby = 'roles.id';
            $sorttype = 'desc';
        }
        $roles->orderBy($sortby, $sorttype);

        if(isset($request['name']) && trim($request['name']) != '')
            $roles->where('roles.name', 'like', "%" . $request['name'] . "%");

        $rolesList=array();

        if(!array_key_exists('pagination', $request)) {
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->init();
        $role = new Role();
        $role->name = $request->name;
        $role->save();
        $role->givePermissionTo($request->permission);
        flash()->success(config('config-variables.flash_messages.dataSaved'));        
        return redirect()->route('roles.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::all();
        $assignedPermissions = $role->permissions->pluck('name')->all();
        return view('roles.edit', compact('role', 'permissions', 'assignedPermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->init();
        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->save();
        $role->syncPermissions();
        $role->givePermissionTo($request->permission);
        flash()->success(config('config-variables.flash_messages.dataSaved'));        
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Role::where('id', $id)->delete()) {
            flash()->success(config('config-variables.flash_messages.dataDeleted'));
        }else{
            flash()->error(config('config-variables.flash_messages.dataNotDeleted'));
        }
        return redirect()->route('roles.index');
    }
}
