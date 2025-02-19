<?php

declare(strict_types=1);

if (!function_exists('current_site')) {
    function current_site()
    {
        return app()->bound('site') ? app('site') : null;
    }
}

if (!function_exists('current_domain')) {
    function current_domain()
    {
        return app('domain');
    }
}
