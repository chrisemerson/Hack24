<?php
namespace BigButton\App\Button;

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
