<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
	use HasSlug;

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug'
    ];

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
     * Make the given slug unique.
     */
    public static function makeSlugUniqueBeforeCreate(string $slug): string
    {
        $originalSlug = $slug;
        $i = 1;

        while (self::checkOtherRecordExistsWithSlug($slug) || $slug === '') {
            $slug = $originalSlug.'-'.$i++;
        }

        return $slug;
    }

    /**
     * Determine if a record exists with the given slug.
     */
    private static function checkOtherRecordExistsWithSlug(string $slug): bool
    {
        return (bool) static::where('slug', $slug)
            ->first();
    }
}
