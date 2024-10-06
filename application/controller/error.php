<?php

namespace Controller;

final class Error extends \BaseController
{
    final public function index(
        \Base $f3
    ): void {
        $code = intval($f3->get('ERROR.code'));
        $message = strval($f3->get('ERROR.text'));

        $res = [
            'code' => $code,
            'type' => 'ERR_UNKNOWN',
            'title' => 'Hata',
            'message' => $message,
        ];

        $this->error($res);
    }
}