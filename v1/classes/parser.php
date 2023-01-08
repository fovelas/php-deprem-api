<?php

class Parser
{
    /**
     * Get xml file from api.
     *
     * @param string $date
     * @return string
     */
    public function get_xml($date)
    {
        $url = 'http://udim.koeri.boun.edu.tr/zeqmap/xmlt/' . strval($date) . '.xml';

        try {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
            // curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0');
            // curl_setopt($curl, CURLOPT_FAILONERROR, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_TIMEOUT, 30);
            $res = curl_exec($curl);
            $http_status = intval(curl_getinfo($curl, CURLINFO_HTTP_CODE));
            curl_close($curl);

            if ($http_status == 404) {
                return false;
            }
        } catch (Exception $err) {
            return false;
        }

        return $res;
    }

    /**
     * Parse earthquakes from xml.
     *
     * @param string $date
     * @param integer $limit
     * @param string $filter_city
     * @return array
     */
    public function parse($date, $limit = 50, $filter_city = 'none')
    {
        $xml_res = $this->get_xml($date);

        if ($xml_res == false || $xml_res == null || $xml_res == '') {
            return false;
        }

        $earthquakes_array = [];

        $xml = new SimpleXMLElement($xml_res, LIBXML_NOCDATA);

        foreach ($xml->earhquake as $earthquake) {
            $raw_date = explode(" ", strval($earthquake['name']));
            $date = $raw_date[0];
            $time = $raw_date[1];

            $raw_location = trim(strval($earthquake['lokasyon']));
            $raw_location = explode('(', $raw_location);

            $location = trim($raw_location[0]);
            $city = trim(str_replace(array('(', ')'), '', $raw_location[1]));

            if (strpos($location, 'REVIZE') !== false) {
                $location = explode('REVIZE', $location);
                $location = trim($location[0]);
            }

            if (strpos($location, 'Ýlksel') !== false) {
                $location = explode('Ýlksel', $location);
                $location = trim($location[0]);
            }

            if (strpos($city, 'REVIZE') !== false) {
                $city = explode('REVIZE', $city);
                $city = trim($city[0]);
            }

            if (strpos($city, 'Ýlksel') !== false) {
                $city = explode('Ýlksel', $city);
                $city = trim($city[0]);
            }

            if (substr($location, -1) == '-') {
                $location = str_replace('-', '', $location);
            }

            if ($city == null || $city == '') {
                $city = 'YOK';
            }

            $earthquake_obj = array(
                'date' => $date,
                'time' => $time,
                'location' => $location,
                'city' => $city,
                'lat' => strval($earthquake['lat']),
                'lng' => strval($earthquake['lng']),
                'mag' => strval($earthquake['mag']),
                'depth' => strval($earthquake['Depth']),
            );

            if ($filter_city == 'none') {
                $earthquakes_array[] = $earthquake_obj;
            } else {
                if (strtolower($city) == $filter_city) {
                    $earthquakes_array[] = $earthquake_obj;
                }
            }

            if (count($earthquakes_array) >= $limit) {
                break;
            }
        }

        $config = include './config/config.php';

        $res = array(
            'github' => $config['github'],
            'warning' => $config['warning'],
            'reference' => $config['reference'],
            'earthquakes' => $earthquakes_array,
        );

        return $res;
    }
}
