<?php

namespace App\Models;

use App\Models\MenuItem;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menus';

    /**
     * Get the comments for the blog post.
     */
    public function items()
    {
        return $this->hasMany('App\Models\MenuItem');
    }

    public function generate()
    {
        $items = $this->items()
            ->where('is_active', 1)
            ->orderBy('order')
            ->get()
            ->toArray();
        
        return self::buildMenuTree($items);
    }

    /**
     * Iterate through the menu structure and build the parent child relationships
     *
     * @param array $menuArray
     * @param int   $parent
     *
     * @return array
     */
    private static function buildMenuTree(array $menuArray, $parent = 0)
    {
        $items = [];
        foreach ($menuArray as $menuItem) {
            if ((int)$menuItem['parent_id'] === (int)$parent) {
                $menuItem['children'] = isset($menuItem['children'])
                    ? $menuItem['children']
                    : self::buildMenuTree($menuArray, $menuItem['id']);
                if (!$menuItem['children']) {
                    unset($menuItem['children']);
                }
                $items[] = $menuItem;
            }
        }
        
        return $items;
    }
}
