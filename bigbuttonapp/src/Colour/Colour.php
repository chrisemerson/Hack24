<?php
namespace BigButton\App\Colour;

use BigButton\App\Exceptions\InvalidColourValueException;

class Colour
{
    /** @var int */
    private $red;

    /** @var int */
    private $green;

    /** @var int */
    private $blue;

    function __construct($red, $green, $blue)
    {
        $this->guardAgainstInvalidColourValue($red, "Red");
        $this->guardAgainstInvalidColourValue($green, "Green");
        $this->guardAgainstInvalidColourValue($blue, "Blue");

        $this->red = $red;
        $this->green = $green;
        $this->blue = $blue;
    }

    /** @return int */
    public function getRed()
    {
        return $this->red;
    }

    /** @param int */
    public function setRed($red)
    {
        $this->red = $red;
    }

    /** @return int */
    public function getGreen()
    {
        return $this->green;
    }

    /** @param int */
    public function setGreen($green)
    {
        $this->green = $green;
    }

    /** @return int */
    public function getBlue()
    {
        return $this->blue;
    }

    /** @param int */
    public function setBlue($blue)
    {
        $this->blue = $blue;
    }

    /** @param int */
    private function guardAgainstInvalidColourValue($colourValue, $label)
    {
        if (!is_numeric($colourValue) || $colourValue < 0 || $colourValue > 255) {
            throw new InvalidColourValueException(
                "Invalid " . $label . " value '" . $colourValue . "' - Must be an int between 0 and 255"
            );
        }
    }
}
