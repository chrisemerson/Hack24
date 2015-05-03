<?php
namespace BigButton\App\TextMessage;

use BigButton\App\Button\TextMessageListener;

class InboundMessageHandler
{
    /** @var TextMessageListener[] */
    private $listeners = [];

    public function registerListener(TextMessageListener $listener)
    {
        $this->listeners[] = $listener;
    }

    public function onTextMessageReceived(InboundMessage $message)
    {
        foreach ($this->listeners as $listener) {
            $listener->onTextMessageReceived($message);
        }
    }
}
