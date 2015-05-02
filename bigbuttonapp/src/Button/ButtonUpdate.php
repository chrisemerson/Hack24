<?php
namespace BigButton\App\Button;

class ButtonUpdate
{
    /** @var Colour */
    private $colour;

    /** @var ScreenBitmap */
    private $screenBitmap;

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

    /**
     * @param ScreenBitmap $screenBitmap
     */
    public function setScreenBitmap(ScreenBitmap $screenBitmap)
    {
        $this->screenBitmap = $screenBitmap;
    }

    /**
     * @return ScreenBitmap
     */
    public function getScreenBitmap()
    {
        return $this->screenBitmap;
    }
}
