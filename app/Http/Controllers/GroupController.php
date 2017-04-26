<?php

namespace App\Http\Controllers;

use DB;
use View;
use App\Models\Menu;
use App\Models\Group;
use App\Models\MenuItem;
use App\Models\MenuItemGroup;
use Illuminate\Http\Request;

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
        $groups = DB::table('groups')->select('*', DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y %H:%i:%s") as "created_datetime"'));

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
        $group = new Group();        
        $group->name = $request->group_name;
        $group->status = $request->status ? 1 : 0;
        $group->company_id = 1;
        $group->save();

        foreach($request->groupItems as $item) {
            $menuItems = new MenuItemGroup();
            $menuItems->group_id = $group->id;
            $menuItems->menu_item_id = $item;
            $menuItems->save();
        }

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
        $group = Group::with('menuItems')->find($id);
        $modules = $group->menuItems->pluck('menu_item_id')->toArray();
        $menu = Menu::where('company_id', 1)->where('name', 'Sidebar')->first();
        $menuTree = $menu->generate();
        return view('groups.edit', compact('group', 'menu', 'menuTree', 'modules'));
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
        $group = Group::findOrFail($id);
        $group->name = $request->group_name;
        $group->status = $request->status ? 1 : 0;
        $group->company_id = 1;
        $group->save();

        $oldGroupItems = MenuItemGroup::where('group_id', $group->id)->delete();

        foreach($request->groupItems as $item) {
            $menuItems = new MenuItemGroup();
            $menuItems->group_id = $group->id;
            $menuItems->menu_item_id = $item;
            $menuItems->save();
        }

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
        if (!Group::where('id', $id)->delete()) {
            $message = config('config-variables.flash_messages.dataNotDeleted');
            $type = 'danger';
        }
        flash()->message($message, $type);

        return redirect()->route('groups.index', ['domain' => app('request')->route()->parameter('company')]);
    }
}
