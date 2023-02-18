<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

return array(
    'app_name' => 'Türkiye Deprem API',
    'version' => '1.0.2-beta',
    'latest_update' => '18.02.2023 02:25',
    'github' => 'https://github.com/hakansrndk60/php-deprem-api',
    'warning' => 'Söz konusu bilgi, veri ve haritalar Boğaziçi Üniversitesi Rektörlüğü’nün yazılı izni ve onayı olmadan herhangi bir şekilde ticari amaçlı kullanılamaz.',
    'reference' => 'http://www.koeri.boun.edu.tr/scripts/lasteq.asp',
);
