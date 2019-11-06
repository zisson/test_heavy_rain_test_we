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
         $city   = $rand ? $this->randomCity() : $this->staticCity();
        //$city   = [1, 2, 1, 5, 2, 4, 1, 0, 1, 2, 6, 4, 5, 2, 3, 4, 1, 2];
        /* add your code here */
        $borderOne = $this->locatePrimaryBorder($city);
        $borderTwo = $this->locateSecondBorder($city);

        $rightBorder = ($borderOne[0] > $borderTwo[0] ) ? $borderOne : $borderTwo;
        $leftBorder = ($borderOne[0] < $borderTwo[0] ) ? $borderOne : $borderTwo;
        $result = $this->floodPerimeter($city, $leftBorder,  $rightBorder);

        echo json_encode($city) . " => " . $result . "\n";
    }

    /**
     * @param array $city
     * @return array
     */
    private function locatePrimaryBorder(array $city)
    {
        return [array_keys($city, max($city))[0], max($city) ];
    }

    /**
     * @param array $city
     * @return array
     */
    private function locateSecondBorder(array $city)
    {
        $max = max($city);
        $key = array_keys($city, $max);

        unset($city[$key[0]]);
        return [array_keys($city, max($city))[0],max($city)];
    }

    /**
     * @param array $city
     * @param array $leftBorder
     * @param array $rightBorder
     * @return float|int|mixed
     */
    private function floodPerimeter(array $city, array $leftBorder, array $rightBorder)
    {

        $largeurPerimeter = $rightBorder[0] - $leftBorder[0] - self::AJUSTER_COORD;
        $perimeter = $leftBorder[1] *  $largeurPerimeter;


        $i = 0;
        $perimeterIn = 0;

        while ($i < count($city)) {
            if (($i > $leftBorder[0]) &&  ($i < $rightBorder[0])) {
                $perimeterIn += $city[$i];
            }
            $i++;
        }
        return ($perimeter - $perimeterIn);
    }
}
