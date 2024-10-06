<?php

// Config headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
date_default_timezone_set('Europe/Istanbul');

define('ROOT_PATH', __DIR__);

// Dependencies
require ROOT_PATH . '/vendor/autoload.php';
require_once ROOT_PATH . '/system/autoload.php';
require_once ROOT_PATH . '/application/autoload.php';
