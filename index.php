<?php

require __DIR__.'/vendor/autoload.php';
include_once(__DIR__.'/database/Database.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$path = trim($_SERVER['REQUEST_URI'], '/');

$path = parse_url( $path, PHP_URL_PATH);

$path=explode('/', $path);

if (isset($path[1])) {
	$path=$path[1];
}else{$path=$path[0];}
if(empty($path)){
    $path='/';
}
require_once 'router/Router.php';
require_once 'routes/web.php';


if($_SERVER['REQUEST_METHOD'] == 'POST'){
  Router::run_post($path, $_POST);
}
if($_SERVER['REQUEST_METHOD'] == 'GET'){
  Router::run_get($path,$_GET);
}