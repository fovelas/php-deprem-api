<?php

$version_major = 1;
$version_minor = 0;
$version_patch = 2;

$config['version_code'] = $version_major * 10000 . $version_minor * 100 . $version_patch;
$config['version_name'] = $version_major . '.' . $version_minor . '.' . $version_patch;

$config['development'] = true;
$config['maintenance'] = false;

$config['github'] = 'https://github.com/fovelas/php-deprem-api';
$config['warning'] = 'Söz konusu bilgi, veri ve haritalar Boğaziçi Üniversitesi Rektörlüğü’nün yazılı izni ve onayı olmadan herhangi bir şekilde ticari amaçlı kullanılamaz.';
$config['reference'] = 'http://www.koeri.boun.edu.tr/scripts/lasteq.asp';

$config['latest_update'] = '06.10.2024 16:30';

return $config;