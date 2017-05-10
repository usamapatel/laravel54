<?php

namespace App\Http\Controllers;

use DB;
use View;
use Landlord;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Widget;
use App\Models\WidgetType;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class WidgetsController extends Controller
{
    public $title;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->menuId = null;
        $this->title = 'Widget';
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
        unset($this->menuId);
    }

    /**
     * Initialize variables.
     *
     * @return void
     */
    public function init()
    {
        $companyId = Landlord::getTenants()['company']->id;
        $menu = Menu::where('company_id', $companyId)->where('name', 'Sidebar')->first();
        $this->menuId = $menu->id;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('widgets.index');
    }

    /**
     * Get widget data.
     *
     * @return \Illuminate\Http\Response
     */
    public function getWidgetData()
    {
        $request = $this->request->all();
        $widgets = DB::table('widgets')->select('*', DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y %H:%i:%s") as "created_datetime"'));

        $sortby = 'widgets.created_datetime';
        $sorttype = 'desc';

        if (isset($request['sortby'])) {
            $sortby = $request['sortby'];
            $sorttype = $request['sorttype'];
        }

        $widgets->orderBy($sortby, $sorttype);

        if (isset($request['name']) && trim($request['name']) !== '') {
            $widgets->where('widgets.name', 'like', '%'.$request['name'].'%');
        }

        $widgetsList = [];

        if (!array_key_exists('pagination', $request)) {
            $widgets = $widgets->paginate($request['pagination_length']);
            $widgetsList = $widgets;
        } else {
            $widgetsList['total'] = $widgets->count();
            $widgetsList['data'] = $widgets->get();
        }

        $response = $widgetsList;

        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->init();
        $WidgetTypes = WidgetType::generate();
        $WidgetTree = Widget::generate();
        $menuItems = MenuItem::where('menu_id', $this->menuId)->get()->toArray();
        $allWidgetControllers = Menu::buildMenuTree($menuItems);
        return view('widgets.create', compact('WidgetTypes', 'WidgetTree', 'allWidgetControllers'));
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
        $widget = new Widget();
        $widget->icon = $request->widget_icon;
        $widget->name = $request->widget_name;
        $widget->slug = $request->widget_slug;
        $widget->description = $request->description;
        $widget->width = $request->widget_width;
        $widget->status = $request->status ? 1 : 0;
        $widget->widget_type_id = $request->widget_type;
        $widget->parent_id = $request->widget_parent;
        $widget->menu_item_id = $request->widget_controller;
        $widget->company_id = 1;
        $widget->save();

        $companyId = Landlord::getTenants()['company']->id;
        $permission = new Permission();
        $permission->name = $companyId.'.'.(config('config-variables.widget_permission_identifier')). '.' .$widget->id;
        $permission->save();

        flash()->success(config('config-variables.flash_messages.dataSaved'));

        return redirect()->route('widgets.index', ['domain' => app('request')->route()->parameter('company')]);
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
        $this->init();
        $widget = Widget::find($id);
        $WidgetTypes = WidgetType::generate();
        $WidgetTree = Widget::generate();
        $menuItems = MenuItem::where('menu_id', $this->menuId)->get()->toArray();
        $allWidgetControllers = Menu::buildMenuTree($menuItems);

        return view('widgets.edit', compact('widget', 'WidgetTypes', 'WidgetTree', 'menuItems', 'allWidgetControllers'));
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
        $widget = Widget::findOrFail($id);
        $widget->icon = $request->widget_icon;
        $widget->name = $request->widget_name;
        $widget->slug = $request->widget_slug;
        $widget->description = $request->description;
        $widget->width = $request->widget_width;
        $widget->status = $request->status ? 1 : 0;
        $widget->widget_type_id = $request->widget_type;
        $widget->parent_id = $request->widget_parent;
        $widget->menu_item_id = $request->widget_controller;
        $widget->company_id = 1;
        $widget->save();

        flash()->success(config('config-variables.flash_messages.dataSaved'));

        return redirect()->route('widgets.index', ['domain' => app('request')->route()->parameter('company')]);
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
        if (!Widget::where('id', $id)->delete()) {
            $message = config('config-variables.flash_messages.dataNotDeleted');
            $type = 'danger';
        }
        flash()->message($message, $type);

        return redirect()->route('widgets.index', ['domain' => app('request')->route()->parameter('company')]);
    }
}
