<?php
namespace BigButton\App\Button;

class ButtonUpdate
{
    /** @var Colour */
    private $colour;

    /** @var ScreenBitmap */
    private $screenBitmap;

    public function setLEDColour(Colour $colour)
    {
        $this->colour = $colour;
    }

    public function setScreenBitmap(ScreenBitmap $screenBitmap)
    {
        $this->screenBitmap = $screenBitmap;
    }
}
