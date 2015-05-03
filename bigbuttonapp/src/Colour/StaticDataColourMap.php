<?php
namespace BigButton\App\Colour;

class StaticDataColourMap implements ColourMap
{
    private $dataMap = [
        'blue' => [0, 0, 255],
        'green' => [0, 255, 0],
        'red' => [255, 0, 0],
        'yellow' => [255, 255, 0],
        'purple' => [255, 0, 255],
        'cyan' => [0, 255, 255],
        'white' => [255, 255, 255],
        'black' => [0, 0, 0]
    ];

    public function getColourFromName($name)
    {
        if (array_key_exists(strtolower($name), $this->dataMap)) {
            list($red, $green, $blue) = $this->dataMap[strtolower($name)];
            return new Colour($red, $green, $blue);
        }

        return new Colour(0, 0, 0);
    }
}
