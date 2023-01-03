<?php
require_once 'classes/parser.php';

/**
 * Send error message.
 *
 * @param string $message
 * @param integer $code
 * @return void
 */
function error($message, $code)
{
    http_response_code(404);

    $res = array(
        'error' => array(
            'message' => $message,
            'code' => $code,
        ),
    );

    echo json_encode($res, JSON_UNESCAPED_UNICODE);
}

$f3 = Base::instance();

$f3->route('GET /get',
    function ($f3, $params) {
        $GLOBALS['params'] = $params;

        if (!isset($_GET['year']) || !isset($_GET['month'])) {
            error(Response::$ERR_MISSING_PARAMS, 101);
            return;
        } else {
            $date = $_GET['year'] . $_GET['month'];
        }

        if (isset($_GET['limit'])) {
            $limit = intval($_GET['limit']);

            if ($limit <= 0) {
                error(Response::$ERR_INVALID_LIMIT, 102);
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

        $parser = new Parser();
        echo json_encode($parser->parse($date, $limit, $city), JSON_UNESCAPED_UNICODE);
    }
);

$f3->route('GET /last24hours',
    function ($f3, $params) {
        $GLOBALS['params'] = $params;

        $date = 'son24saat';

        if (isset($_GET['limit'])) {
            $limit = intval($_GET['limit']);

            if ($limit <= 0) {
                error(Response::$ERR_INVALID_LIMIT, 102);
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

        $parser = new Parser();
        echo json_encode($parser->parse($date, $limit, $city), JSON_UNESCAPED_UNICODE);
    }
);
