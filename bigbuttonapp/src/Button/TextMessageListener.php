<?php
namespace BigButton\App\Button;

use BigButton\App\TextMessage\InboundMessage;

interface TextMessageListener
{
    public function onTextMessageReceived(InboundMessage $message);
}
