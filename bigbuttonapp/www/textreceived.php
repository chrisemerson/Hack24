<?php
require_once "../vendor/autoload.php";

$data = file_get_contents("php://input");

$inboundMessageFactory = new \BigButton\App\TextMessage\InboundMessageFactory();
$inboundMessage = $inboundMessageFactory->constructFromXML($data);

$inboundMessageHandler = new \BigButton\App\TextMessage\InboundMessageHandler();

$inboundMessageHandler->registerListener(new \BigButton\App\TextMessageListeners\ReplyToTextMessageListener());
$inboundMessageHandler->registerListener(
    new \BigButton\App\TextMessageListeners\UpdateButtonColour(
        new \BigButton\App\Colour\StaticDataColourMap()
    )
);

$inboundMessageHandler->onTextMessageReceived($inboundMessage);
