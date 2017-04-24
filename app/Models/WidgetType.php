<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WidgetType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'widget_type';

    public static function generate()
    {
        $types = self::all()->toArray();

        return self::buildWidgetTypeTree($types);
    }

    /**
     * Iterate through the menu structure and build the parent child relationships.
     *
     * @param array $menuArray
     * @param int   $parent
     *
     * @return array
     */
    private static function buildWidgetTypeTree(array $types, $parent = 0)
    {
        $items = [];
        foreach ($types as $widgetType) {
            if ((int) $widgetType['parent_id'] === (int) $parent) {
                $widgetType['children'] = isset($widgetType['children'])
                    ? $widgetType['children']
                    : self::buildWidgetTypeTree($types, $widgetType['id']);
                if (! $widgetType['children']) {
                    unset($widgetType['children']);
                }
                $items[] = $widgetType;
            }
        }

        return $items;
    }
}
