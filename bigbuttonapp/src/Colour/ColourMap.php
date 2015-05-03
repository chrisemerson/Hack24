<?php
namespace BigButton\App\Colour;

interface ColourMap
{
    /**
     * @param string $name
     * @return Colour
     */
    public function getColourFromName($name);
}
