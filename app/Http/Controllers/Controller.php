<?php

namespace App\Http\Controllers;

use Auth;
use View;
use Landlord;
use App\Models\Menu;
use App\Models\MenuItem;
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
            if(Auth::check()) {
                $userRoles = Auth::user()->roles;
                foreach ($userRoles as $role) {
                    $permissions = $role->permissions;
                    $menuItemIdArray = $permissions->map(function($item, $key){
                        return explode('.',$item->name)[1];
                    });
                }
                $menuItemArray = MenuItem::whereIn('id', $menuItemIdArray)->get()->toArray();
                $menuItemArray = Menu::buildMenuTree($menuItemArray,0);
                View::share('menu_items', $menuItemArray);
                View::share('companies', Auth::user()->companies);
            }
	        return $next($request);
	    });
    }
}
