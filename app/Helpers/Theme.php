<?php

use Caffeinated\Themes\Facades\Theme;

if (! function_exists('view')) {
    /**
     * Render theme view file.
     *
     * @param string $view
     * @param array  $data
     * @param mixed  $mergeData
     *
     * @return View
     */
    function view($view = null, $data = [], $mergeData = [])
    {
        return View::make($view, $data);
    }
}

if (! function_exists('asset')) {
    /**
     * Generate a HTML link to the given asset using HTTP for the
     * currently active theme.
     *
     * @return string
     *
     * @param mixed $path
     */
    function asset($path)
    {
        return Theme::asset($path, null, true);
    }
}
