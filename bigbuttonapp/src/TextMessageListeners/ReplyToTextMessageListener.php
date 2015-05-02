<?php
namespace BigButton\App\TextMessageListeners;

use BigButton\App\Button\TextMessageListener;
use BigButton\App\TextMessage\InboundMessage;
use Esendex\Authentication\LoginAuthentication;
use Esendex\DispatchService;
use Esendex\Model\DispatchMessage;
use Esendex\Model\Message;

class ReplyToTextMessageListener implements TextMessageListener
{
    public function onTextMessageReceived(InboundMessage $message)
    {
        $replyMessage = new DispatchMessage(
            "BigButton",
            $message->getFrom(),
            "You said: " . $message->getMessageText(),
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
