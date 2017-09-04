<?php

if (! function_exists('dd')) {
    function dd($data)
    {
        echo '<pre>';
        print_r($data);
        exit();
    }
}

if (! function_exists('env')) {
    function env($key, $default = null)
    {
        if(getenv($key) !='')
            return getenv($key);
        else
            return $default;
    }
}