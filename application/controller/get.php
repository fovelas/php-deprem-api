<?php

namespace Controller;

use Constant\Response;
use Util\HTTPClient;
use Util\XMLParser;

final class Get extends \BaseController
{
    final public function index(): void
    {
        if (!isset($_GET['year'], $_GET['month'])) {
            $this->error(Response::$ERR_MISSING_PARAMS);
        }

        $date = $_GET['year'] . $_GET['month'];
        $url = 'http://udim.koeri.boun.edu.tr/zeqmap/xmlt/' . $date . '.xml';

        // --------------------------------------------------------------------

        if (isset($_GET['limit'])) {
            $limit = intval($_GET['limit']);

            if ($limit <= 0 || $limit > 10000) {
                $this->error(Response::$ERR_INVALID_LIMIT);
            }
        } else {
            $limit = 50;
        }

        // --------------------------------------------------------------------

        if (isset($_GET['city'])) {
            $city = $_GET['city'];
        } else {
            $city = null;
        }

        // --------------------------------------------------------------------

        if (isset($_GET['mag'])) {
            $mag = doubleval($_GET['mag']);

            if ($mag < 0 || $mag > 11) {
                $this->error(Response::$ERR_INVALID_MAGNITUDE);
            }
        } else {
            $mag = 0;
        }

        // --------------------------------------------------------------------

        $http_client = new HTTPClient();
        $xml_parser = new XMLParser();

        // --------------------------------------------------------------------

        [$result, $xml_data] = $http_client->get($url);

        if (!$result) {
            $this->error(Response::$ERR_UNKNOWN);
        }

        $earthquakes_data = $xml_parser->parse($xml_data);

        // --------------------------------------------------------------------

        $filtered_earthquakes_data = [];

        foreach ($earthquakes_data as $item) {
            if ($city === null) {
                if (doubleval($item['mag']) >= $mag) {
                    $filtered_earthquakes_data[] = $item;
                }
            } else {
                if (strtolower($item['city']) === strtolower($city)) {
                    if (doubleval($item['mag']) >= $mag) {
                        $filtered_earthquakes_data[] = $item;
                    }
                }
            }

            if (count($filtered_earthquakes_data) >= $limit) {
                break;
            }
        }

        // --------------------------------------------------------------------

        $config = include ROOT_PATH . '/application/config/config.php';

        $res = array(
            'github' => $config['github'],
            'warning' => $config['warning'],
            'reference' => $config['reference'],
            'earthquakes' => $filtered_earthquakes_data,
        );

        $this->json($res);
    }
}