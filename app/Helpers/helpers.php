<?php

if (!function_exists('settings')) {
    function settings($key, $default = null)
    {
        $settings = app()->bound('settings') ? app('settings') : null;
        if (!$settings) return $default;

        return $settings->get($key);
    }
}
