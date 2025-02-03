<?php

if (!function_exists('settings')) {
    function settings($key, $default = null)
    {
        $settings = app()->bound('settings') ? app('settings') : null;
        if (is_null($settings)) {
            return $default;
        }

        return $settings->get($key) ?? $default;
    }
}
