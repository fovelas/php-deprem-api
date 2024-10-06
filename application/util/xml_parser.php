<?php

namespace Util;

use SimpleXMLElement;

final class XMLParser
{
    final public function parse(
        string $xml_data
    ): array {
        $xml_element = new SimpleXMLElement($xml_data, LIBXML_NOCDATA);
        $json = json_decode(json_encode($xml_element, JSON_UNESCAPED_UNICODE), true);
        $earthquakes = $json['earhquake'];

        // print_r($json);

        $output = [];

        foreach ($earthquakes as $earthquake) {
            $attrs = $earthquake['@attributes'];

            [$date, $time] = $this->parseDateAndTime($attrs['name']);
            [$location, $city] = $this->parseLocationAndCity($attrs['lokasyon']);
            $lat = trim($attrs['lat']);
            $lng = trim($attrs['lng']);
            $mag = trim($attrs['mag']);
            $depth = trim($attrs['Depth']);

            $output[] = [
                'date' => $date,
                'time' => $time,
                'location' => $location,
                'city' => $city,
                'lat' => $lat,
                'lng' => $lng,
                'mag' => $mag,
                'depth' => $depth,
            ];
        }

        return $output;
    }

    private function parseDateAndTime(
        string $s
    ): array {
        $raw_date = explode(' ', $s);
        $date = trim($raw_date[0]);
        $time = trim($raw_date[1]);
        return [$date, $time];
    }

    private function parseLocationAndCity(
        string $s
    ): array {
        $raw_location = explode('(', $s);

        if (count($raw_location) >= 2) {
            $location = trim($raw_location[0]);
            $city = str_replace(['(', ')'], '', trim($raw_location[1]));
        } else {
            $location = trim($raw_location[0]);
            $city = 'YOK';
        }

        $location = str_replace(['Ýlksel', 'REVIZE'], '', $location);
        $city = str_replace(['Ýlksel', 'REVIZE'], '', $city);

        if (substr($location, -1) == '-') {
            $location = str_replace('-', '', $location);
        }

        $location = trim($location);
        $city = trim($city);
        return [$location, $city];
    }
}
