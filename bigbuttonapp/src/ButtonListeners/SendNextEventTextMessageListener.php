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
            $event = $events['events'][0];

            $start = new DateTime($event['start']);
            $end = new DateTime($event['start']);

            $now = new DateTime();

            // The event is in the past
            if ($start < $now) {
                $past = true;
                $delay = $start->diff($now);
            }
            // It's in the future
            else {
                $past = false;
                $delay = $start->diff($start);
            }

            $message = sprintf("Your next events %s in %s hours: \n\n%s\n", ($past ? 'ends' : 'is'), $delay->format('%h hour(s)'), $event['summary'], $event['description']);
            //$message = print_r($events, true);
        }

        OutboundMessage::send(file_get_contents("/home/vagrant/.phoneno"), $message);
    }
}
