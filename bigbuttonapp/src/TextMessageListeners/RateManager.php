<?php
namespace BigButton\App\TextMessageListeners;

use BigButton\App\Button\Button;
use BigButton\App\Button\ButtonUpdate;
use BigButton\App\Button\TextMessageListener;
use BigButton\App\Colour\ColourMap;
use BigButton\App\TextMessage\InboundMessage;
use BigButton\App\TextMessage\OutboundMessage;
use PHPInsight\Sentiment;

class RateManager implements TextMessageListener
{
    /**
     * @var Sentiment
     */
    private $sentiment;
    /**
     * @var ColourMap
     */
    private $colourMap;

    public function __construct(ColourMap $colourMap, Sentiment $sentiment)
    {
        $this->sentiment = $sentiment;
        $this->colourMap = $colourMap;
    }

    public function onTextMessageReceived(InboundMessage $message)
    {
        if (preg_match("/manager/i", $message->getMessageText(), $matches)) {
            //$scores = $this->sentiment->score($message->getMessageText());
            $class = $this->sentiment->categorise($message->getMessageText());

            if ($class == 'pos') {
                $colour = 'green';
            }
            else if ($class == 'neu') {
                $colour = 'yellow';
            }
            else {
                $colour = 'red';
            }

            $buttonUpdate = new ButtonUpdate();
            $buttonUpdate->setLEDColour($this->colourMap->getColourFromName($colour));

            $button = new Button();
            $button->sendUpdate($buttonUpdate);

//
//            if ($accepted) {
//                $colour = 'green';
//
//                $money = rand(1, trim($matches[1]));
//
//                OutboundMessage::send($message->getFrom(), sprintf('You have been given a loan of £%s, yay!', number_format($money, 2, '.', ',')));
//            }
//            else {
//                $colour = 'red';
//
//                OutboundMessage::send($message->getFrom(), 'No');
//            }

//            $buttonUpdate = new ButtonUpdate();
//            $buttonUpdate->setLEDColour($this->colourMap->getColourFromName($colour));
//
//            $button = new Button();
//            $button->sendUpdate($buttonUpdate);
        }
    }
}
