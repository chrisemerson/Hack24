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

        OutboundMessage::send(file_get_contents("/home/vagrant/.phoneno"), "Test");

        $chronofy = new Chronofy($apiKey);
        $events = $chronofy->getEvents(new DateTime('today'), new DateTime('tomorrow'));

        if (count($events['events'])) {
            $message = print_r($events['events'][0], true);
        } else {
            $message = "sadface";
        }

    }
}
