<?php

use Routes\Route;

require __DIR__.'/vendor/autoload.php';
include_once(__DIR__.'/config/DB.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

include_once(__DIR__.'/routes/web.php');