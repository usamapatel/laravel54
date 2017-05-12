<?php

namespace App\Listeners;

use App\Events\CompanyRegistered;
use App\Models\Menu;
use App\Models\Widget;
use App\Models\MenuItem;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use DB;

class CreateDefaultMenuItems
{
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
        $defaultMenuItems = config('defaultmenuitems.' . $event->userType);

        $role = new Role();
        $role->name = $company->id.'.Admin';
        $role->display_name = 'Admin';
        $role->save();

        $user->assignRole($role->name);

        $menu = new Menu();
        $menu->company_id = $company->id;
        $menu->name = 'Sidebar';
        $menu->save();

        foreach ($defaultMenuItems as $mainMenuItem) {
            $menuItem = new MenuItem();
            $menuItem->menu_id = $menu->id;
            $this->createMenu($menuItem, $mainMenuItem, null);
            $menuItem->save();

            $permission = new Permission();
            $permission->name = $menu->company_id. '.' . config('config-variables.menu_item_permission_identifier') . '.' .$menuItem->id;
            $permission->save();

            DB::table('role_has_permissions')->insert([
            [
                'permission_id' => $permission->id,
                'role_id' => $role->id
            ]
            ]);

            if (isset($mainMenuItem['children']) && count($mainMenuItem['children']) > 0) {
                $this->generateChildrenMenus($mainMenuItem['children'], $menuItem, $menu, $role);
            }

            if (isset($mainMenuItem['widget']) && count($mainMenuItem['widget']) > 0) {
                foreach ($mainMenuItem['widget'] as $widgetItem) {
                    $widget = new Widget();
                    $widget->menu_item_id = $menuItem->id;
                    $widget->company_id = $company->id;
                    $this->createWidget($widget, $widgetItem, null);
                    $widget->save();

                    $permission = new Permission();
                    $permission->name = $company->id. '.' . config('config-variables.widget_permission_identifier') . '.' .$widget->id;
                    $permission->save();
                    DB::table('role_has_permissions')->insert([
            [
                'permission_id' => $permission->id,
                'role_id' => $role->id
            ]
            ]);

                    if (isset($widgetItem['children']) && count($widgetItem['children']) > 0) {
                        $this->generateChildrenWidgets($widgetItem['children'], $widget, $role);
                    }
                }
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
            $permission->name = $menu->company_id. '.' . config('config-variables.menu_item_permission_identifier') . '.' .$menuItem->id;
            $permission->save();
            DB::table('role_has_permissions')->insert([
            [
                'permission_id' => $permission->id,
                'role_id' => $role->id
            ]
            ]);

            if (isset($item['children']) && count($item['children']) > 0) {
                $this->generateChildrenMenus($item['children'], $menuItem, $menu, $role);
            }

            if (isset($item['widget']) && count($item['widget']) > 0) {
                foreach ($item['widget'] as $widgetItem) {
                    $widget = new Widget();
                    $widget->menu_item_id = $menuItem->id;
                    $widget->company_id = $menu->company_id;
                    $this->createWidget($widget, $widgetItem, null);
                    $widget->save();

                    $permission = new Permission();
                    $permission->name = $menu->company_id. '.' . config('config-variables.widget_permission_identifier') . '.' .$widget->id;
                    $permission->save();
                    DB::table('role_has_permissions')->insert([
            [
                'permission_id' => $permission->id,
                'role_id' => $role->id
            ]
            ]);

                    if (isset($widgetItem['children']) && count($widgetItem['children']) > 0) {
                        $this->generateChildrenWidgets($widgetItem['children'], $widget, $role);
                    }
                }
            }
        }
    }

    /**
     * [generateChildrenWidgets description].
     *
     * @param array  $childrenWidgets [description]
     * @param object $parent        [description]
     * @param object $role          [description]
     *
     * @return [type] [description]
     */
    public function generateChildrenWidgets($childrenWidgets, $parent, $role)
    {
        foreach ($childrenWidgets as $item) {
            $widget = new Widget();
            $widget->menu_item_id = $parent->id;
            $widget->company_id = $parent->company_id;
            $this->createWidget($widget, $item, $parent->id);
            $widget->save();

            $permission = new Permission();
            $permission->name = $parent->company_id. '.' . config('config-variables.widget_permission_identifier') . '.' .$widget->id;
            $permission->save();
            DB::table('role_has_permissions')->insert([
            [
                'permission_id' => $permission->id,
                'role_id' => $role->id
            ]
            ]);

            if (isset($item['children']) && count($item['children']) > 0) {
                $this->generateChildrenWidgets($item['children'], $widget, $role);
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

    /**
     * [createWidget description].
     *
     * @param object &$item  [description]
     * @param array  $values [description]
     *
     * @return [type] [description]
     */
    public function createWidget(&$item, $values, $parent)
    {
        $item->icon = $values['icon'];
        $item->name = $values['name'];
        $item->slug = $values['slug'];
        $item->description = $values['description'];
        $item->parent_id = $parent;
        $item->width = $values['width'];
        $item->status = $values['status'];
        $item->settings = $values['settings'];
        $item->widget_type_id = $values['widget_type_id'];
    }
}
