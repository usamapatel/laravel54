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
use Landlord;
use DB;
use JavaScript;
use LaravelLocalization;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                if(Landlord::getTenants()['company']->slug != 'www') {
                    $widgetsAccessArray = array();
                    $menuItemIdArray = array();
                    $roles = Auth::user()->roles;

                    $currentCompanyRoles = $roles->filter(function ($value, $key) {
                        $companyId = Landlord::getTenants()['company']->id;
                        if(explode(".", $value->name)[0] == $companyId) {
                            return $value;
                        }
                    })->values();

                    foreach ($currentCompanyRoles as $role) {
                        $permissions = $role->permissions;
                        $menuItemIds = $permissions->map(function ($item, $key) {
                            if(strpos($item->name, '.' . config('config-variables.menu_item_permission_identifier') .  '.') !== false) {
                                return explode('.', $item->name)[2];
                            }
                        })->unique()->toArray();
                        $menuItemIdArray = array_merge($menuItemIdArray, $menuItemIds);

                        $widgetsAccess = $permissions->map(function ($item, $key) {
                            if(strpos($item->name, '.' . config('config-variables.widget_permission_identifier') .  '.') !== false) {
                                return explode('.', $item->name)[2];
                            }
                        })->values()->toArray();
                        $widgetsAccessArray = array_merge($widgetsAccessArray, $widgetsAccess);
                    }                    
                    // code refactoring remaining here
                    $menuItemArray = MenuItem::whereIn('id', $menuItemIdArray)->get()->toArray();
                    $menuItemArray = Menu::buildMenuTree($menuItemArray, 0);

                    $widgetArray = Widget::whereIn('id', $widgetsAccessArray)->pluck('slug')->toArray();
                    $request->session()->put('widgetAccess', $widgetArray);

                    $currentCompany = Landlord::getTenants()['company'];

                    View::share('menu_items', $menuItemArray);                
                    View::share('currentCompany', $currentCompany);
                    View::share('currentCompanyRoles', $currentCompanyRoles);
                }
                JavaScript::put([
                    'locale' => LaravelLocalization::getCurrentLocale(),
                ]);               
                View::share('companies', Auth::user()->companies);             
            }
            return $next($request);
        });
    }
}
