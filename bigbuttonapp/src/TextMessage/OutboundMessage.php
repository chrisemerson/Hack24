<?php
namespace BigButton\App\TextMessage;

use Esendex\Authentication\LoginAuthentication;
use Esendex\DispatchService;
use Esendex\Model\DispatchMessage;
use Esendex\Model\Message;

class OutboundMessage
{
    public static function send($to, $message)
    {
        $replyMessage = new DispatchMessage(
            "BigButton",
            $to,
            $message,
            Message::SmsType
        );

        $authentication = new LoginAuthentication(
            "EX0159519",
            "chris@cemerson.co.uk",
            "fdPRqcK9nJ3B"
        );

        $service = new DispatchService($authentication);
        $service->send($replyMessage);
    }
}
