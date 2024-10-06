<?php

namespace Controller;

use Constant\Response;

final class Status extends \BaseController
{
    final public function index(): void
    {
        $config = include ROOT_PATH . '/application/config/config.php';

        $res = array(
            'version_code' => $config['version_code'],
            'version_name' => $config['version_name'],
            'latest_update' => $config['latest_update'],
            'documentation' => $config['github'],
        );

        $this->json($res);
    }
}
