<?php
namespace BigButton\App\ButtonListeners;

use BigButton\App\Button\ButtonListener;
use BigButton\App\TextMessage\OutboundMessage;
use Vivait\Chronofy\Chronofy;
use DateTime;

class SendNextEventTextMessageListener implements ButtonListener
{
    public function onButtonPress()
    {
        $apiKey = file_get_contents("/home/vagrant/.cronofy");

        $chronofy = new Chronofy($apiKey);
        $events = $chronofy->getEvents(new DateTime('today'), new DateTime('tomorrow'));

        $message = 0;

        if (count($events['events'])) {
            $message = $events['events'][0]['summary'];
            $message = print_r($events, true);
        }

        OutboundMessage::send(file_get_contents("/home/vagrant/.phoneno"), $message);
    }
}
