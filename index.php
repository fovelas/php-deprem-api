<?php

require_once '__init__.php';

$f3 = \Base::instance();
$f3->set('ONERROR', 'Controller\Error->index');

// Routes
$f3->route('GET /status', 'Controller\Status->index');
$f3->route('GET /get', 'Controller\Get->index');
$f3->route('GET /last24hours', 'Controller\Last24Hours->index');

$f3->run();
