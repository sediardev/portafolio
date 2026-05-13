<?php

if (! function_exists('versioned_asset')) {
    function versioned_asset(string $path): string
    {
        $version = (string) config('app.asset_version');

        if ($version === '') {
            return asset($path);
        }

        return asset($path).'?v='.$version;
    }
}
