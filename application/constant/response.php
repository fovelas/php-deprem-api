<?php

namespace Constant;

final class Response
{
    public static $ERR_MISSING_HEADERS = [
        'code' => 999,
        'type' => 'ERR_MISSING_HEADERS',
        'title' => 'Erişim İzni Verilmedi',
        'message' => 'Siz olduğunuzu doğrulayamıyoruz.',
    ];

    public static $ERR_MISSING_PARAMS = [
        'code' => 999,
        'type' => 'ERR_MISSING_PARAMS',
        'title' => 'Eksik Parametre',
        'message' => 'İsteğin işlenebilmesi için tüm parametrelerin eksiksiz olması gerekmektedir.',
    ];

    public static $ERR_UNNECESSARY_PARAMS = [
        'code' => 999,
        'type' => 'ERR_UNNECESSARY_PARAMS',
        'title' => 'Gereksiz Parametre',
        'message' => 'Gereksiz parametreleri silmeniz gerekmektedir.',
    ];

    // --------------------------------------------------------------------

    public static $ERR_INVALID_LIMIT = [
        'code' => 999,
        'type' => 'ERR_INVALID_LIMIT',
        'title' => 'Hata',
        'message' => 'Limit değeri 0 ile 10000 arasında olmalıdır.',
    ];

    public static $ERR_INVALID_MAGNITUDE = [
        'code' => 999,
        'type' => 'ERR_INVALID_MAGNITUDE',
        'title' => 'Hata',
        'message' => 'Mag değeri 0 ile 11 arasında olmalıdır.',
    ];

    // --------------------------------------------------------------------

    public static $ERR_UNKNOWN = [
        'code' => 999,
        'type' => 'ERR_UNKNOWN',
        'title' => 'Hata',
        'message' => 'Bilinmeyen bir hata oluştu.',
    ];

    public static $ERR_NOT_FOUND = [
        'code' => 999,
        'type' => 'ERR_NOT_FOUND',
        'title' => 'Hata',
        'message' => 'Bulunamadı.',
    ];
}