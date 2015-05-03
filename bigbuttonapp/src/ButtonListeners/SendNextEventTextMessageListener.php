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
            $end = new DateTime($event['end']);

            $now = new DateTime();

            // The event is in the past
            if ($start < $now) {
                $past = true;
                $delay = $end->diff($now);
            }
            // It's in the future
            else {
                $past = false;
                $delay = $start->diff($start);
            }

            $hours = $delay->format('%h');

            $message = sprintf("Your %s event %s in %s hour%s: \n\n%s\n", ($past ? 'current' : 'next'), ($past ? 'ends' : 'is'), $hours, $hours ? 's' : '', $event['summary'], $event['description']);
            //$message = print_r($events, true);
        }

        OutboundMessage::send(file_get_contents("/home/vagrant/.phoneno"), $message);
    }
}
