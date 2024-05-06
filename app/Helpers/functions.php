<?php

if (! function_exists('url')) {
    function url($path)
    {
        return $path;
    }
}
if (! function_exists('json_response')) {
    function json_response($data=null, $httpStatus=200)
    {
        ob_start();
        ob_clean();

        header_remove();
        header('Access-Control-Allow-Origin: *');
        header("Content-type: application/json; charset=utf-8");

        http_response_code($httpStatus);

        echo json_encode($data,JSON_PRETTY_PRINT);

        exit();
    }
}

if (! function_exists('redirect')) {
    function redirect($url, $statusCode = 303)
    {
        header('Location: ' . $url, true, $statusCode);
        die();
    }
}

if (! function_exists('back')) {
    function back()
    {
        $previous='/';
        if(isset($_SERVER['HTTP_REFERER'])) {
            $previous = $_SERVER['HTTP_REFERER'];
        }
        header('Location: ' . $previous, true, 303);
        die();
    }
}

if (! function_exists('env')) {
    function env($key)
    {
        return $_ENV[$key];
    }
}

if (! function_exists('toObject')) {
    function toObject($data,$multiple=false) {
        if(count($data)==1 && !$multiple){
           $data=$data[0];
        }
        $object = new stdClass();
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $value = ToObject($value);
            }
            $object->$key = $value;
        }
        return $object;
    }
}
