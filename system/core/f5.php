<?php

abstract class F5
{
    protected final function error(
        array $response
    ): void {
        http_response_code(404);
        header('Content-Type: application/json; charset=UTF-8');

        $res = array(
            'error' => array(
                'type' => $response['type'],
                'title' => $response['title'],
                'message' => $response['message'],
                'code' => $response['code'],
            ),
        );

        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }

    protected final function success(
        array $response
    ): void {
        http_response_code(200);
        header('Content-Type: application/json; charset=UTF-8');

        $res = array(
            'success' => array(
                'type' => $response['type'],
                'title' => $response['title'],
                'message' => $response['message'],
                'code' => $response['code'],
            ),
        );

        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }

    protected final function json(
        array $data
    ): void {
        http_response_code(200);
        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
}