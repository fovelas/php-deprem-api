<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

return array(
    'app_name' => 'Türkiye Deprem API',
    'version' => '0.0.1-beta',
    'latest_update' => '07.01.2023 19:18',
    'github' => 'https://github.com/hakansrndk60/php-deprem-api',
    'warning' => 'Söz konusu bilgi, veri ve haritalar Boğaziçi Üniversitesi Rektörlüğü’nün yazılı izni ve onayı olmadan herhangi bir şekilde ticari amaçlı kullanılamaz.',
    'reference' => 'http://www.koeri.boun.edu.tr/scripts/lasteq.asp',
);
