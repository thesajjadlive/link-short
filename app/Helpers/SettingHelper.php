<?php

if (!function_exists('setting')) {

    /**
     * description
     *
     * @param $name
     * @param null $default
     * @return string
     */
    function setting($name,$default=null)
    {
        return \App\Models\Setting::getByName($name,$default);
    }
}
