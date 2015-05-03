<?php
namespace BigButton\App\TextMessageListeners;

use BigButton\App\Button\Button;
use BigButton\App\Button\ButtonUpdate;
use BigButton\App\Button\TextMessageListener;
use BigButton\App\Colour\ColourMap;
use BigButton\App\TextMessage\InboundMessage;
use BigButton\App\TextMessage\OutboundMessage;
use PHPInsight\Sentiment;

class Broadway implements TextMessageListener
{
    public function onTextMessageReceived(InboundMessage $message)
    {
        if (preg_match("/^Film$/i", $message->getMessageText(), $matches)) {
            $index = rand(0, 33787);

            $fp = fopen(__DIR__ . "/../../data.csv", 'r');
            $csv = [];

            $i = 0;

            while($row = fgetcsv($fp)) {
                $csv[] = $row[3];

//                if ($i++ > 10) {
//                    break;
//                }
            }

//            $csv = array_map("str_getcsv", file(__DIR__ ."/../../data.csv", "r"));

//            OutboundMessage::send($message->getFrom(), print_r(count($csv), true));
            OutboundMessage::send($message->getFrom(), print_r($csv[$index], true));
//
//            $buttonUpdate = new ButtonUpdate();
//            $buttonUpdate->setLEDColour($this->colourMap->getColourFromName($colour));
//
//            $button = new Button();
//            $button->sendUpdate($buttonUpdate);

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
