<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Menu;
use App\Models\Widget;
use App\Models\MenuItem;
use DB;
use Illuminate\Http\Request;
use Landlord;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use View;

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
        $groups = DB::table('roles')->where('name', 'LIKE', $companyId.'.%')->select('*', DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y %H:%i:%s") as "created_datetime"'));

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
        // $menuItems = MenuItem::all();
        $menu = Menu::where('company_id', Landlord::getTenants()['company']->id)->where('name', 'Sidebar')->first();
        $menuTree = $menu->generate();

        return view('groups.create', compact('menuTree'));
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
        $request = $this->request;        
        $allPermissions = [];
        $company_id = Landlord::getTenants()['company']->id;

        // widgets
        $requestWidgets = $request->widgets;
        
        // fetch all the relevant permission ids based on the menu items
        $menuItems = $request->menuItems;
        $menuItems = MenuItem::whereIn('id', $request->menuItems)->get();

        foreach($menuItems as $item) {
            $allModules = [];
            $allWidgets = [];

            if(isset($requestWidgets[$item->id])) {
                $widgets = Widget::whereIn('id', $requestWidgets[$item->id])->get();

                foreach($widgets as $widget) {
                    $menuItemName = $company_id.'.'.config('config-variables.menu_item_permission_identifier').'.'.$widget->menu_item_id;
                    if(!in_array($menuItemName, $allWidgets)) { 
                        $allWidgets[] = $menuItemName;
                    }
                    $allWidgets[] = $company_id.'.'.config('config-variables.widget_permission_identifier').'.'.$widget->id;
                }
            }

            $allModules[] = $company_id.'.'.config('config-variables.menu_item_permission_identifier').'.'.$item->id;
            while($item->parent_id != null) {
                $item = MenuItem::where('id', $item->parent_id)->first();
                $allModules[] = $company_id.'.'.config('config-variables.menu_item_permission_identifier').'.'.$item->id;
            }
            $allModules = array_reverse($allModules);
            $permissions = array_merge($allModules, $allWidgets);
            $allPermissions = array_merge($allPermissions, $permissions);
        }

        // create a new role for the added group
        $role = Role::create([
            'name'         => $company_id.'.'.$request->group_name,
            'display_name' => $request->group_name,
            'status' => $request->status ? 1 : 0,
        ]);

        $permissions = Permission::whereIn('name', $allPermissions)->pluck('id');

        // Bind all the selected permissions to the newly created role
        $role->permissions()->sync($permissions);
        flash()->success(config('config-variables.flash_messages.dataSaved'));

        return redirect()->route('groups.index', ['domain' => app('request')->route()->parameter('company')]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($company, $id)
    {
        $role = Role::find($id);
        $assignedPermissions = $role->permissions->pluck('id');
        $permissions = Permission::whereIn('id', $assignedPermissions)->get();
        $company_id = Landlord::getTenants()['company']->id;
        $modules = $permissions->map(function ($item, $key) use ($company_id) {
            if(strpos($item->name, '.' . config('config-variables.menu_item_permission_identifier') .  '.') !== false) {
                $menuItemId = explode('.', $item->name);
                return $menuItemId[2];
            }
        })->toArray();

        $widgets = $permissions->map(function ($item, $key) use ($company_id) {
            if(strpos($item->name, '.' . config('config-variables.widget_permission_identifier') .  '.') !== false) {
                $menuItemId = explode('.', $item->name);
                return $menuItemId[2];
            }
        })->toArray();

        $menu = Menu::where('company_id', $company_id)->where('name', 'Sidebar')->first();
        $menuTree = $menu->generate();

        return view('groups.edit', compact('role', 'menu', 'menuTree', 'modules', 'widgets'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $company, $id)
    {
        $request = $this->request;
        $this->init();
        $allPermissions = [];
        $company_id = Landlord::getTenants()['company']->id;

        // widgets
        $requestWidgets = $request->widgets;

        // update role
        $role = Role::findOrFail($id);
        $role->display_name = $request->group_name;
        $role->status = $request->status ? 1 : 0;
        $role->save();

        // fetch all the relevant permission ids based on the menu items
        $menuItems = $request->menuItems;
        $menuItems = MenuItem::whereIn('id', $request->menuItems)->get();

        foreach($menuItems as $item) {
            $allModules = [];
            $allWidgets = [];
            if(isset($requestWidgets[$item->id])) { 
                $widgets = Widget::whereIn('id', $requestWidgets[$item->id])->get();
                foreach($widgets as $widget) {
                    $menuItemName = $company_id.'.'.config('config-variables.menu_item_permission_identifier').'.'.$widget->menu_item_id;
                    if(!in_array($menuItemName, $allWidgets)) { 
                        $allWidgets[] = $menuItemName;
                    }
                    $allWidgets[] = $company_id.'.'.config('config-variables.widget_permission_identifier').'.'.$widget->id;
                }
            }
            
            $allModules[] = $company_id.'.'.config('config-variables.menu_item_permission_identifier').'.'.$item->id;
            while($item->parent_id != null) {
                $item = MenuItem::where('id', $item->parent_id)->first();
                $allModules[] = $company_id.'.'.config('config-variables.menu_item_permission_identifier').'.'.$item->id;
            }
            $allModules = array_reverse($allModules);
            $permissions = array_merge($allModules, $allWidgets);
            $allPermissions = array_merge($allPermissions, $permissions);
        }

        $permissions = Permission::whereIn('name', $allPermissions)->pluck('id');

        // Bind all the selected permissions to the updated role
        $role->permissions()->sync($permissions);

        flash()->success(config('config-variables.flash_messages.dataSaved'));

        return redirect()->route('groups.index', ['domain' => app('request')->route()->parameter('company')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
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
