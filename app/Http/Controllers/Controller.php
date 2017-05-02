<?php

namespace App\Http\Controllers;

use Auth;
use View;
use Landlord;
use App\Models\Menu;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
    	$this->middleware(function ($request, $next) {
    		$companyId = Landlord::getTenants()['company']->id;
	        $menu = Menu::where('company_id', $companyId)->where('name', 'Sidebar')->first();
	        $menuArray = array();
	        if($menu) {
	        	$menuArray = $menu->generate();
	        }
	        View::share('menu_items', $menuArray);
	        if(Auth::check()) {
	        	View::share('companies', Auth::user()->companies);
	        }
	        return $next($request);
	    });
    }
}
