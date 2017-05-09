<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Widget;
use Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                $widgetsAccess = array();
                $userRoles = Auth::user()->roles;
                foreach ($userRoles as $role) {
                    $permissions = $role->permissions;
                    $menuItemIdArray = $permissions->map(function ($item, $key) {
                        if(strpos($item->name, '.' . config('config-variables.menu_item_permission_identifier') .  '.') !== false) {
                            return explode('.', $item->name)[2];
                        }
                    });

                    $widgetsAccess = $permissions->map(function ($item, $key) {
                        if(strpos($item->name, '.' . config('config-variables.widget_permission_identifier') .  '.') !== false) {
                            return explode('.', $item->name)[2];
                        }
                    })->values();
                }
                // code refactoring remaining here
                $menuItemArray = MenuItem::whereIn('id', $menuItemIdArray)->get()->toArray();
                $menuItemArray = Menu::buildMenuTree($menuItemArray, 0);

                $widgetArray = Widget::whereIn('id', $widgetsAccess)->pluck('slug')->toArray();
                $request->session()->put('widgetAccess', $widgetArray);

                View::share('menu_items', $menuItemArray);
                View::share('companies', Auth::user()->companies);
            }

            return $next($request);
        });
    }
}
