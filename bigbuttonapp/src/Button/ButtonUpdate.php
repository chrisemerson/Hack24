<?php
namespace BigButton\App\Button;

use BigButton\App\Colour\Colour;

class ButtonUpdate
{
    /** @var Colour */
    private $colour;

    /**
     * @param Colour $colour
     */
    public function setLEDColour(Colour $colour)
    {
        $this->colour = $colour;
    }

    /**
     * @return Colour
     */
    public function getColour()
    {
        return $this->colour;
    }
}
