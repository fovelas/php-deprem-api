<?php
require_once 'classes/parser.php';

/**
 * Send error message.
 *
 * @param string $message
 * @param integer $code
 * @param string $detail
 * @return void
 */
function error($message, $code, $detail = null)
{
    http_response_code(404);

    if ($detail == null) {
        $res = array(
            'error' => array(
                'message' => $message,
                'code' => $code,
            ),
        );
    } else {
        $res = array(
            'error' => array(
                'message' => $message,
                'detail' => $detail,
                'code' => $code,
            ),
        );
    }

    echo json_encode($res, JSON_UNESCAPED_UNICODE);
}

$f3 = Base::instance();

$f3->route(
    'GET /get',
    function ($f3, $params) {
        $GLOBALS['params'] = $params;

        if (!isset($_GET['year']) || !isset($_GET['month'])) {
            error(Response::$ERR_MISSING_PARAMS, 101, 'year and month parameters must be filled');
            return;
        } else {
            $date = $_GET['year'] . $_GET['month'];
        }

        if (isset($_GET['limit'])) {
            $limit = intval($_GET['limit']);

            if ($limit <= 0) {
                error(Response::$ERR_INVALID_LIMIT, 102, 'limit must be bigger than zero (0)');
                return;
            } else if ($limit > 10000) {
                error(Response::$ERR_INVALID_LIMIT, 102, 'limit must be smaller than ten thousand (10000)');
                return;
            }
        } else {
            $limit = 50;
        }

        if (isset($_GET['city'])) {
            $city = $_GET['city'];
        } else {
            $city = 'none';
        }

        if (isset($_GET['mag'])) {
            $mag = doubleval($_GET['mag']);

            if ($mag < 0) {
                error(Response::$ERR_INVALID_MAGNITUDE, 103, 'magnitude must be bigger than zero (0)');
                return;
            } else if ($mag > 11) {
                error(Response::$ERR_INVALID_MAGNITUDE, 103, 'magnitude must be smaller than eleven (11)');
                return;
            }
        } else {
            $mag = 0;
        }

        $parser = new Parser();
        $data = $parser->parse($date, $limit, $city, $mag);

        if ($data) {
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        } else {
            error(Response::$ERR_NO_RESPONSE, 404);
        }
    }
);

$f3->route(
    'GET /last24hours',
    function ($f3, $params) {
        $GLOBALS['params'] = $params;

        $date = 'son24saat';

        if (isset($_GET['year'])) {
            error(Response::$ERR_UNNECESSARY_PARAMETER, 104, 'year parameter is unnecessary');
            return;
        } else if (isset($_GET['month'])) {
            error(Response::$ERR_UNNECESSARY_PARAMETER, 104, 'month parameter is unnecessary');
            return;
        }

        if (isset($_GET['limit'])) {
            $limit = intval($_GET['limit']);

            if ($limit <= 0) {
                error(Response::$ERR_INVALID_LIMIT, 102, 'limit must be bigger than zero (0)');
                return;
            } else if ($limit > 10000) {
                error(Response::$ERR_INVALID_LIMIT, 102, 'limit must be smaller than ten thousand (10000)');
                return;
            }
        } else {
            $limit = 50;
        }

        if (isset($_GET['city'])) {
            $city = $_GET['city'];
        } else {
            $city = 'none';
        }

        if (isset($_GET['mag'])) {
            $mag = doubleval($_GET['mag']);

            if ($mag < 0) {
                error(Response::$ERR_INVALID_MAGNITUDE, 103, 'magnitude must be bigger than zero (0)');
                return;
            } else if ($mag > 11) {
                error(Response::$ERR_INVALID_MAGNITUDE, 103, 'magnitude must be smaller than eleven (11)');
                return;
            }
        } else {
            $mag = 0;
        }

        $parser = new Parser();
        $data = $parser->parse($date, $limit, $city, $mag);

        if ($data) {
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        } else {
            error(Response::$ERR_NO_RESPONSE, 404);
        }
    }
);
