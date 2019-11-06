<?php

require 'CityBuilder.php';

/**
 *
 */
class HeavyRain extends CityBuilder
{
    const AJUSTER_COORD = 1;

    function __construct(){}

    public function exec($rand = false)
    {
        $city   = [1, 2, 1, 5, 2, 4, 1, 0, 1, 2, 6, 4, 5, 2, 3, 4, 1, 2];
        /* add your code here */
        $result = 0;

        $borderOne = $this->locatePrimaryBorder($city);
        $borderTwo = $this->locateSecondborder($city);

        $leftborder = ($borderOne < $borderTwo ) ? $borderOne : $borderTwo;
        var_dump($leftborder, $borderOne, $borderTwo);
        echo json_encode($city) . " => " . $result . "\n";
    }

    private function locatePrimaryBorder(array $city)
    {
        $leftborder = [
            'x_one' => array_keys($city, max($city))[0],
            'y_one' => max($city)
        ];
        return $leftborder;
    }

    private function locateSecondborder(array $city)
    {
        $max = max($city);
        $key = array_keys($city, $max);

        unset($city[$key[0]]);
        $rightBorder = [
            'x_two' =>  array_keys($city, max($city))[0],
            'y_two' => max($city)
        ];
        return $rightBorder;
    }
}
