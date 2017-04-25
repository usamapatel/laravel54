<?php

namespace App\Http\Controllers;

use App\Models\Widget;
use App\Models\WidgetType;
use DB;
use Illuminate\Http\Request;
use View;

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
        return view('widgets.index');
    }

    /**
     * Get role data.
     *
     * @return \Illuminate\Http\Response
     */
    public function getWidgetData()
    {
        $request = $this->request->all();
        $widgets = DB::table('widgets')->select('*', DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y %H:%i:%s") as "created_datetime"'));

        $sortby = 'widgets.id';
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
        $WidgetTypes = WidgetType::generate();
        $WidgetTree = Widget::generate();

        return view('widgets.create', compact('WidgetTypes', 'WidgetTree'));
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
        $request = $this->request;
        $this->init();
        $widget = new Widget();
        $widget->icon = $request->widget_icon;
        $widget->name = $request->widget_name;
        $widget->title = $request->widget_title;
        $widget->description = $request->description;
        $widget->width = $request->widget_width;
        $widget->status = $request->status ? 1 : 0;
        $widget->widget_type_id = $request->widget_type;
        $widget->parent_id = $request->widget_parent;
        $widget->company_id = 1;

        $widget->save();

        flash()->success(config('config-variables.flash_messages.dataSaved'));

        return redirect()->route('widgets.index');
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
    public function edit($id)
    {
        $widget = Widget::find($id);
        $WidgetTypes = WidgetType::generate();
        $WidgetTree = Widget::generate();

        return view('widgets.edit', compact('widget', 'WidgetTypes', 'WidgetTree'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $widget = Widget::findOrFail($id);
        $widget->icon = $request->widget_icon;
        $widget->name = $request->widget_name;
        $widget->title = $request->widget_title;
        $widget->description = $request->description;
        $widget->width = $request->widget_width;
        $widget->status = $request->status ? 1 : 0;
        $widget->widget_type_id = $request->widget_type;
        $widget->parent_id = $request->widget_parent;
        $widget->company_id = 1;
        $widget->save();

        flash()->success(config('config-variables.flash_messages.dataSaved'));

        return redirect()->route('widgets.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = config('config-variables.flash_messages.dataDeleted');
        $type = 'success';
        if (!Widget::where('id', $id)->delete()) {
            $message = config('config-variables.flash_messages.dataNotDeleted');
            $type = 'danger';
        }
        flash()->message($message, $type);

        return redirect()->route('widgets.index');
    }
}
