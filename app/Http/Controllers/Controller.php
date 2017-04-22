<?php

namespace App\Http\Controllers;

use View;
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
    	// find menu by company and name for sidebar name will be "Sidebar"
    	// eg: $menu = Menu::where('company_id', $company_id)->where('name', 'Sidebar')->first();
    	$menu = Menu::find(1);
        $menuArray = $menu->generate();
    	View::share('menu_items', $menuArray );
    }
}
