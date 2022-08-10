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
                $path = "http://mv1.xxmm.com/".$base;
                break;
            case 'movie242':
                $path = "http://mv2.xxmmww.com/".$base;
                break;
            case 'movie210':
                $path = "http://mv3.xxmmww.com/".$base;
                break;
            case 'movie98':
                $path = "http://mv4.xxmmww.com/".$base;
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