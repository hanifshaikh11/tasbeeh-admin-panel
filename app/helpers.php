<?php

use App\Models\Setting;

// Setting Key-value
if (!function_exists('setting')) {
    function setting($key, $default = null)
    {
        return Setting::where('key', $key)->value('value') ?? $default;
    }
}


// Sidebar - Active Class
if (!function_exists('activeClass')) {

    // function activeClass($route, $active = null, $normal = null)
    // {
    //     $active = $active ?? 'bg-blue-600 text-white font-semibold';
    //     $normal = $normal ?? 'text-gray-300 hover:bg-gray-800 hover:text-white';
    //     return request()->routeIs($route)
    //         ? $active
    //         : $normal;
    // }

    function activeClass($route)
    {
        return request()->routeIs($route)
            ? 'bg-indigo-600 text-white shadow-md'
            : 'text-gray-500 hover:bg-indigo-600 hover:text-white';
    }
}


// Roles
if (!function_exists('formatRoleName')) {

    function formatRoleName($role)
    {
        if (!$role) {
            return 'N/A';
        }
        return ucwords(str_replace('_', ' ', $role));
    }

}
