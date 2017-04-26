<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuItem;
use DB;
use Illuminate\Http\Request;
use View;

class ModulesController extends Controller
{
    public $title;
    public $uniqueUrl;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->title = 'Module';
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
        return view('modules.index');
    }

    /**
     * Get module data.
     *
     * @return \Illuminate\Http\Response
     */
    public function getModuleData()
    {
        $request = $this->request->all();
        $modules = DB::table('menu_items')
                ->select('*', DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y %H:%i:%s") as "created_datetime"'));

        $sortby = 'menu_items.id';
        $sorttype = 'desc';

        if (isset($request['sortby'])) {
            $sortby = $request['sortby'];
            $sorttype = $request['sorttype'];
        }

        $modules->orderBy($sortby, $sorttype);

        if (isset($request['name']) && trim($request['name']) !== '') {
            $modules->where('menu_items.name', 'like', '%'.$request['name'].'%');
        }

        $modulesList = [];

        if (!array_key_exists('pagination', $request)) {
            $modules = $modules->paginate($request['pagination_length']);
            $modulesList = $modules;
        } else {
            $modulesList['total'] = $modules->count();
            $modulesList['data'] = $modules->get();
        }

        $response = $modulesList;

        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$menuItems = MenuItem::where('menu_id', 1)->where('type', 'Module')->get()->toArray();
        $allModules = Menu::buildMenuTree($menuItems);

        return view('modules.create', compact('allModules'));
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
        $module = new MenuItem();
        $module = $this->setVariables($module, $request);
        $module->save();
        flash()->success(config('config-variables.flash_messages.dataSaved'));

        return redirect()->route('modules.index', ['domain' => app('request')->route()->parameter('company')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $moduleId
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($company, $moduleId)
    {
        $module = MenuItem::find($moduleId);
        $menuItems = MenuItem::where('menu_id', 1)->where('type', 'Module')->get()->toArray();
        $allModules = Menu::buildMenuTree($menuItems);

        return view('modules.edit', compact('module', 'allModules'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     * @param mixed                    $modulesId
     * @param mixed                    $moduleId
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $company, $moduleId)
    {
        $this->init();
        $module = MenuItem::findOrFail($moduleId);
        $module = $this->setVariables($module, $request);
        $module->save();
        flash()->success(config('config-variables.flash_messages.dataSaved'));

        return redirect()->route('modules.index', ['domain' => app('request')->route()->parameter('company')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int   $id
     * @param mixed $moduleId
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($company, $moduleId)
    {
        $message = config('config-variables.flash_messages.dataDeleted');
        $type = 'success';
        if (!MenuItem::where('id', $moduleId)->delete()) {
            $message = config('config-variables.flash_messages.dataNotDeleted');
            $type = 'danger';
        }
        flash()->message($message, $type);

        return redirect()->route('modules.index', ['domain' => app('request')->route()->parameter('company')]);
    }

    /**
     * Generete Module URL.
     *
     * @return \Illuminate\Http\Response
     */
    public function generateModuleUrl(Request $request)
    {
    	$moduleType = $request->module_type;
    	if($moduleType == "Module") {
    		return ['moduleUrl' => '#'];
    	}
    	$moduleName = $request->module_name;
    	$moduleUrl = str_slug($moduleName, '-');
    	$parent = $request->parent_id ? MenuItem::find($request->parent_id) : null;
    	if($parent) {
    		$moduleUrl = $parent->url . '/' . $moduleUrl;
    	}
    	if($parent->is_publicly_visible == 1 && $request->is_publicly_visible == 0) {
    		$moduleUrl = '/admin' . $moduleUrl;
    	}
    	$moduleUrl = $this->generateUniqueUrl($moduleUrl, '');
        return ['moduleUrl' => $this->uniqueUrl];
    }

    private function setVariables($module, $request)
    {
        $module->menu_id = 1;
        $module->name = $request->name;
        $module->description = $request->description;
        $module->url = $request->url;
        $module->type = $request->type;
        $module->parent_id = $request->parent_id ? $request->parent_id : null;
        $module->order = $request->order;
        $module->icon = $request->icon;
        $module->is_active = $request->is_active ? 1 : 0;
        $module->is_shown_on_menu = $request->is_shown_on_menu ? 1 : 0;
        $module->is_publicly_visible = $request->is_publicly_visible ? 1 : 0;
        return $module;
    }

    /**
     * Get unique module url
     *
     */	
    public function generateUniqueUrl($url, $extra)
    {
    	$moduleUrlExp = explode("/", $url);
        $moduleUrlTemp = str_slug($moduleUrlExp[count($moduleUrlExp) - 1].'-'.$extra);
        $moduleUrlExp[count($moduleUrlExp) - 1] = $moduleUrlTemp;
        $uniqueUrl = implode("/", $moduleUrlExp);
        if(MenuItem::where('url',$uniqueUrl)->exists())
        {
            $this->generateUniqueUrl($url, $extra + 1);
            return;
        }
        $this->uniqueUrl = $uniqueUrl;
    }
}