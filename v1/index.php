<?php
date_default_timezone_set('Europe/Istanbul');

require '../vendor/autoload.php';
require_once './classes/response.php';

$f3 = Base::instance();

$f3->route('GET /',
    function () {
        $config = include './config/config.php';
        $res = array(
            'app_name' => $config['app_name'],
            'version' => $config['version'],
            'latest_update' => $config['latest_update'],
        );
        echo json_encode($res);
    }
);

// $f3->set('ONERROR', function ($f3) {});
$f3->set('CACHE', false);

// routes
require_once './routes/get.php';

$f3->run();
