<?php

namespace App\Http\Controllers;

use View;
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
        View::share ( 'title', $this->title );
        parent::__construct();
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.dashboard');
    }
}
