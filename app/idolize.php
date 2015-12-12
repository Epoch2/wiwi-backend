<?php

/**
 * Created by Johan Vester
 * johan@wasitworth.it
 *
 * (c) wasitworth.it
 */

/*
 * This file contains various helper methods intended to allow certain
 * Laravel specific packages to work with Lumen.
 */

if (!function_exists('config_path')) {
    /**
     * Get the configuration path.
     *
     * @param  string $path
     * @return string
     */
    function config_path($path = '')
    {
        return app()->basePath() . '/config' . ($path ? '/' . $path : $path);
    }
}
