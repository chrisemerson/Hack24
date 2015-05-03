<?php
namespace BigButton\App\Colour;

class ImageColourExtractor
{
    /**
     * @return Colour
     * @param string
     **/
    public function getMostUsedColourFromImageByURL($url)
    {
        $command =
            "convert"
            . " " . escapeshellarg($url)
            . " -colors 16"
            . " -depth 8"
            . " -format \"%c\""
            . " histogram:info:"
            . " | head -n 1";

        $colourInfo = shell_exec($command);

        if (preg_match("/srgb\\((\\d+),(\\d+),(\\d+)\\)/", $colourInfo, $matches)) {
            return new Colour($matches[1], $matches[2], $matches[3]);
        } else {
            return new Colour(0, 0, 0);
        }
    }
}
