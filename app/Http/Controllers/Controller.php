<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Widget;
use App\Models\Companies;
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
            if (Auth::check() && count(Landlord::getTenants()) > 0 ) {
                if(Landlord::getTenants()['company']->slug != 'www') {
                    $widgetsAccessArray = array();
                    $menuItemIdArray = array();
                    $role = null;

                    if(isset($request->role)) {
                        $role = Auth::user()->roles()->where('id', $request->role)->first();
                    } else {
                        $role = Auth::user()->roles()->first();
                    }

                    if(!$role) {
                        return response()->json(['error' => 'not found'], 404);
                    }

                    $currentCompanyRoles = Auth::user()->roles->filter(function ($value, $key) {
                        $companyId = Landlord::getTenants()['company']->id;
                        if(explode(".", $value->name)[0] == $companyId) {
                            return $value;
                        }
                    })->values();

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

                $companies = Auth::user()->companies()->where('is_invitation_accepted', 1)->get();
                View::share('companies', $companies);
            }
            return $next($request);
        });
    }
}
