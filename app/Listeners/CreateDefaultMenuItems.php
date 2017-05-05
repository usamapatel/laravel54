<?php

namespace App\Listeners;

use App\Events\CompanyRegistered;
use App\Models\Menu;
use App\Models\MenuItem;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateDefaultMenuItems
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param CompanyRegistered $event
     *
     * @return void
     */
    public function handle(CompanyRegistered $event)
    {
        $company = $event->company;
        $user = $event->user;

        $role = new Role();
        $role->name = $company->id.".Company Admin";
        $role->display_name = "Company Admin";
        $role->save();

        $user->assignRole($role->name);

        $menu = new Menu();
        $menu->company_id = $company->id;
        $menu->name = 'Sidebar';
        $menu->save();

        $defaultMenuItems = config('defaultmenuitems');
        foreach ($defaultMenuItems as $mainMenuItem) {
            $menuItem = new MenuItem();
            $menuItem->menu_id = $menu->id;
            $this->createMenu($menuItem, $mainMenuItem, null);
            $menuItem->save();

            $permission = new Permission();
            $permission->name = $menu->company_id.'.'.$menuItem->id;
            $permission->save();
            $role->givePermissionTo($permission->name);

            if(isset($mainMenuItem['children']) && count($mainMenuItem['children']) > 0) {
                $this->generateChildrenMenus($mainMenuItem['children'], $menuItem, $menu, $role);
            }
        }
    }

    /**
     * [generateChildrenMenus description].
     *
     * @param array  $childrenMenus [description]
     * @param object $parent        [description]
     * @param object $menu          [description]
     *
     * @return [type] [description]
     */
    public function generateChildrenMenus($childrenMenus, $parent, $menu, $role)
    {
        foreach ($childrenMenus as $item) {
            $menuItem = new MenuItem();
            $menuItem->menu_id = $menu->id;
            $this->createMenu($menuItem, $item, $parent->id);
            $menuItem->save();

            $permission = new Permission();
            $permission->name = $menu->company_id.'.'.$menuItem->id;
            $permission->save();
            $role->givePermissionTo($permission->name);
            
            if(isset($item['children']) && count($item['children']) > 0) {
                $this->generateChildrenMenus($item['children'], $menuItem, $menu, $role);
            }
        }
    }

    /**
     * [createMenu description].
     *
     * @param object &$item  [description]
     * @param array  $values [description]
     *
     * @return [type] [description]
     */
    public function createMenu(&$item, $values, $parent)
    {
        $item->name = $values['name'];
        $item->description = $values['description'];
        $item->url = $values['url'];
        $item->type = $values['type'];
        $item->parent_id = $parent;
        $item->order = $values['order'];
        $item->icon = $values['icon'];
        $item->is_active = $values['is_active'];
        $item->is_shown_on_menu = $values['is_shown_on_menu'];
        $item->is_publicly_visible = $values['is_publicly_visible'];
    }
}
