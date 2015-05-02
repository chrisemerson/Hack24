<?php
namespace BigButton\App\TextMessageListeners;

use BigButton\App\Button\Button;
use BigButton\App\Button\ButtonUpdate;
use BigButton\App\Button\TextMessageListener;
use BigButton\App\Colour\ColourMap;
use BigButton\App\TextMessage\InboundMessage;

class UpdateButtonColour implements TextMessageListener
{
    /** @var ColourMap */
    private $colourMap;

    public function __construct(ColourMap $colourMap)
    {
        $this->colourMap = $colourMap;
    }

    public function onTextMessageReceived(InboundMessage $message)
    {
        if (preg_match("/^colour(.*)$/i", $message->getMessageText(), $matches)) {
            $colourToUpdateTo = $this->colourMap->getColourFromName($matches[1]);

            $buttonUpdate = new ButtonUpdate();
            $buttonUpdate->setLEDColour($colourToUpdateTo);

            $button = new Button();
            $button->sendUpdate($buttonUpdate);
        }
    }
}
