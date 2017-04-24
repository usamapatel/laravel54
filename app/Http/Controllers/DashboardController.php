<?php

namespace App\Http\Controllers;

use View;
use App\Models\Widget;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->title = 'Dashboard';
        View::share('title', $this->title);
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $widgets = Widget::where('company_id', '=', 1)->get();
        return view('dashboard.dashboard', compact('widgets'));
    }
}
