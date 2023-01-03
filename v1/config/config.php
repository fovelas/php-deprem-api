<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

if ($method == "OPTIONS") {
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
    header("HTTP/1.1 200 OK");
    die();
}

return array(
    'app_name' => 'Turkiye Deprem API',
    'version' => '0.0.1-beta',
    'latest_update' => '03.01.2023 14:15',
    'github' => 'https://github.com/hakansrndk60/php-deprem-api',
    'warning' => 'Söz konusu bilgi, veri ve haritalar Boğaziçi Üniversitesi Rektörlüğü’nün yazılı izni ve onayı olmadan herhangi bir şekilde ticari amaçlı kullanılamaz.',
    'reference' => 'http://www.koeri.boun.edu.tr/scripts/lasteq.asp',
);
