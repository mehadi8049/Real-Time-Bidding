<?php

class Router {
  public static $get_routes;
  public static $post_routes;
  public static function get($url, $arr) {
    if($url!='/'){
      $url=ltrim($url,'/');
      $url=rtrim($url,'/');
    }
    
    self::$get_routes[$url] = $arr;
  }

  public static function run_get($url, $get=array()) {
    if (array_key_exists($url, self::$get_routes)) {
       $arr=self::$get_routes[$url];
       $arr=explode('@', $arr);
       $controller=new $arr[0];
       return $controller->{$arr[1]}($get);
    }else {
      
      include 'resources/404.php';
    }
  }
  

  public static function post($url, $arr) {
    if($url!='/'){
      $url=ltrim($url,'/');
      $url=rtrim($url,'/');
    }
    self::$post_routes[$url] = $arr;
  }
  public static function run_post($url, $post=array()) {
    
    if (array_key_exists($url, self::$post_routes)) {
       $arr=self::$post_routes[$url];
       $arr=explode('@', $arr);
       $controller=new $arr[0]();
       return $controller->{$arr[1]}($post);
    }else {
      include 'resources/404.php';
    }
  }
}