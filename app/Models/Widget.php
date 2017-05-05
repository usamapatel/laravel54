<?php

namespace App\Models;

use App\Models\Basemodel as Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Widget extends Model
{
    use HasSlug;

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'widgets';

    public static function generate()
    {
        $types = self::all()->toArray();

        return self::buildWidgetTree($types);
    }

    /**
     * Iterate through the menu structure and build the parent child relationships.
     *
     * @param array $menuArray
     * @param int   $parent
     *
     * @return array
     */
    private static function buildWidgetTree(array $types, $parent = 0)
    {
        $items = [];
        foreach ($types as $widgetTree) {
            if ((int) $widgetTree['parent_id'] === (int) $parent) {
                $widgetTree['children'] = isset($widgetTree['children'])
                    ? $widgetTree['children']
                    : self::buildWidgetTree($types, $widgetTree['id']);
                if (!$widgetTree['children']) {
                    unset($widgetTree['children']);
                }
                $items[] = $widgetTree;
            }
        }

        return $items;
    }
}
