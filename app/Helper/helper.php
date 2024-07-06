<?php

if(!function_exists('get_format_date')){
    function get_format_date($date, $format)
    {
        $newData = date($format, strtotime($date));
        return $newData;
    }
}
