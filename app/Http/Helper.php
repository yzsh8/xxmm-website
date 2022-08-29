<?php

if (! function_exists('get_web_url')) {
    function get_web_url($path){
        if(strpos($path,"http://")===false && strpos($path,"https://")===false){
        	return '/'.$path;
        }
        return $path;
    }
}

if (! function_exists('get_video_url')) {
    function get_video_url($path){
        //如果携带远程地址的，直接放出去
        if(strpos($path,"http://")===true || strpos($path,"https://")===true){
            return $path;
        }

        //字符串切割数组
        $info = explode('/',$path);
        if(!isset($info[1])){
            //空的数据，直接返回
            return "";
        }

        //通过文件夹名称，来判断服务器来源
        $serv = $info[1];

        unset($info[0]);
        unset($info[1]);

        $base = join('/',$info);

        //针对不同的电影的解析
        switch ($serv) {
            case 'movie1':
                $path = "//mv1.xxmm.com/".$base;
                break;
            case 'movie242':
                $path = "//mv2.xxmmww.com/".$base;
                break;
            case 'movie210':
                $path = "//mv3.xxmmww.com/".$base;
                break;
            case 'movie98':
                $path = "//mv4.xxmmww.com/".$base;
                break;
            case 'movie18':
                $path = "//mv5.xxmmww.com/".$base;
                break;
            case 'movie66':
                $path = "//mv6.xxmmww.com/".$base;
                break;
        }

        return $path;
    }
}

if (!function_exists('objectToArray')) {
    function objectToArray($object) {
        return json_decode(json_encode($object), true);
    }
}

if (!function_exists('colorToCode')) {
    function colorToCode($color) {
        $code = '';
        switch($color){
        case 'red':
            $code = 'FF0000';
            break;
        case 'black':
            $code = '000000';
            break;
        case 'green':
            $code = '00FF00';
            break;
        case 'silver':
            $code = 'C0C0C0';
            break;
        case 'white':
            $code = 'FFFFFF';
            break;
        case 'yellow':
            $code = 'FFFF00';
            break;
        case 'blue':
            $code = '00FF00';
            break;
        }

        return $code;
    }
}