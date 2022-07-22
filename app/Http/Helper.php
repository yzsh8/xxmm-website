<?php

if (! function_exists('get_web_url')) {
    function get_web_url($path){
        if(strpos($path,"http://")===false && strpos($path,"https://")===false){
        	return '/'.$path;
        }
        return $path;
    }
}

if (!function_exists('objectToArray')) {
    function objectToArray($object) {
        return json_decode(json_encode($object), true);
    }
}