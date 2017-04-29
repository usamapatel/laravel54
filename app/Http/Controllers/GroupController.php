<?php

namespace App\Http\Controllers;

use DB;
use View;
use Landlord;
use App\Models\Companies;
use App\Models\Menu;
use App\Models\Group;
use App\Models\MenuItem;
use App\Models\MenuItemGroup;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class GroupController extends Controller
{
    public $title;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->title = 'Group';
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
     * Get widget data.
     *
     * @return \Illuminate\Http\Response
     */
    public function getGroupData()
    {
        $request = $this->request->all();
        $companyId = Landlord::getTenants()['company']->id;
        $groups = DB::table('roles')->where('name', 'LIKE', $companyId.'%')->select('*', DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y %H:%i:%s") as "created_datetime"'));

        $sortby = 'groups.created_datetime';
        $sorttype = 'desc';

        if (isset($request['sortby'])) {
            $sortby = $request['sortby'];
            $sorttype = $request['sorttype'];
        }

        $groups->orderBy($sortby, $sorttype);

        if (isset($request['name']) && trim($request['name']) !== '') {
            $groups->where('groups.name', 'like', '%'.$request['name'].'%');
        }

        $groupsList = [];

        if (!array_key_exists('pagination', $request)) {
            $groups = $groups->paginate($request['pagination_length']);
            $groupsList = $groups;
        } else {
            $groupsList['total'] = $groups->count();
            $groupsList['data'] = $groups->get();
        }

        $response = $groupsList;

        return $response;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('groups.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menuItems = MenuItem::all();
        $menu = Menu::where('company_id', 1)->where('name', 'Sidebar')->first();
        $menuTree = $menu->generate();
        return view('groups.create', compact('menuItems', 'menuTree'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request = $this->request;
        $this->init();
        $company_id = Landlord::getTenants()['company']->id;

        // create a new role for the added group
        $role = Role::create([
            'name' => $company_id . '.' . $request->group_name,
            'display_name' => $request->group_name,
        ]);
        
        // fetch all the relevant permission ids based on the menu items
        $menuItems = MenuItem::whereIn('id', $request->groupItems)->get();
        $permissionsName = $menuItems->map(function($item, $key) use($company_id) {
            return $company_id . '.' . $item->id;
        });
        $permissions = Permission::whereIn('name', $permissionsName)->pluck('id');
        
        // Bind all the selected permissions to the newly created role
        $role->permissions()->sync($permissions);
        flash()->success(config('config-variables.flash_messages.dataSaved'));

        return redirect()->route('groups.index', ['domain' => app('request')->route()->parameter('company')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($company, $id)
    {
        $role = Role::find($id);
        $assignedPermissions = $role->permissions->pluck('id');
        
        $permissions = Permission::whereIn('id', $assignedPermissions)->get();
        $company_id = Landlord::getTenants()['company']->id;
        $modules = $permissions->map(function($item, $key) use($company_id) {
            $menuItemId = explode('.',$item->name);
            return (int)$menuItemId[1];
        })->toArray();

        $menu = Menu::where('company_id', 1)->where('name', 'Sidebar')->first();
        $menuTree = $menu->generate();
        return view('groups.edit', compact('role', 'menu', 'menuTree', 'modules'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $company, $id)
    {
        $request = $this->request;
        $this->init();
        $company_id = Landlord::getTenants()['company']->id;

        // update role
        $role = Role::findOrFail($id);
        $role->display_name = $request->group_name;
        // $role->status = $request->status ? 1 : 0;
        $role->save();

        // fetch all the relevant permission ids based on the menu items
        $menuItems = MenuItem::whereIn('id', $request->groupItems)->get();
        $permissionsName = $menuItems->map(function($item, $key) use($company_id) {
            return $company_id . '.' . $item->id;
        });
        $permissions = Permission::whereIn('name', $permissionsName)->pluck('id');

        // Bind all the selected permissions to the updated role      
        $role->permissions()->sync($permissions);

        flash()->success(config('config-variables.flash_messages.dataSaved'));
        return redirect()->route('groups.index', ['domain' => app('request')->route()->parameter('company')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($company, $id)
    {
        $message = config('config-variables.flash_messages.dataDeleted');
        $type = 'success';
        if (!Role::where('id', $id)->delete()) {
            $message = config('config-variables.flash_messages.dataNotDeleted');
            $type = 'danger';
        }
        flash()->message($message, $type);

        return redirect()->route('groups.index', ['domain' => app('request')->route()->parameter('company')]);
    }
}
