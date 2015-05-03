<?php
namespace BigButton\App\TextMessageListeners;

use BigButton\App\Button\Button;
use BigButton\App\Button\ButtonUpdate;
use BigButton\App\Button\TextMessageListener;
use BigButton\App\Colour\ColourMap;
use BigButton\App\TextMessage\InboundMessage;
use BigButton\App\TextMessage\OutboundMessage;

class GiveLoan implements TextMessageListener
{
    public function __construct(ColourMap $colourMap)
    {
        $this->colourMap = $colourMap;
    }

    public function onTextMessageReceived(InboundMessage $message)
    {
        OutboundMessage::send(file_get_contents("/home/vagrant/.phoneno"), $message->getMessageText());
        OutboundMessage::send($message->getFrom(), $message->getMessageText());
        var_dump($message->getFrom());

        if (preg_match("/^Loan me £?([0-9\\.]+)/i", $message->getMessageText(), $matches)) {
            $accepted = rand(0,1);

            OutboundMessage::send($message->getFrom(), $accepted);

            if ($accepted) {
                $colour = 'green';

                $money = rand(1, trim($matches[1]));

                OutboundMessage::send($message->getFrom(), sprintf('You have been given a loan of £%.02f', $money));
            }
            else {
                $colour = 'red';

                OutboundMessage::send($message->getFrom(), 'No');
            }

            $buttonUpdate = new ButtonUpdate();
            $buttonUpdate->setLEDColour($this->colourMap->getColourFromName($colour));

            $button = new Button();
            $button->sendUpdate($buttonUpdate);
        }
    }
}
