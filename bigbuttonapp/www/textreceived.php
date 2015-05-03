<?php

require_once "../vendor/autoload.php";

$data = file_get_contents("php://input");

$inboundMessageFactory = new \BigButton\App\TextMessage\InboundMessageFactory();
$inboundMessage = $inboundMessageFactory->constructFromXML($data);

$inboundMessageHandler = new \BigButton\App\TextMessage\InboundMessageHandler();

$inboundMessageHandler->registerListener(
    new \BigButton\App\TextMessageListeners\GiveLoan(
        new \BigButton\App\Colour\GoogleImagesLookupColourMap()
    )
);

$inboundMessageHandler->registerListener(
    new \BigButton\App\TextMessageListeners\RateManager(
        new \BigButton\App\Colour\GoogleImagesLookupColourMap(),
        new \PHPInsight\Sentiment()
    )
);

$inboundMessageHandler->registerListener(
    new \BigButton\App\TextMessageListeners\Broadway(
        new \BigButton\App\Colour\GoogleImagesLookupColourMap()
    )
);

$inboundMessageHandler->registerListener(
    new \BigButton\App\TextMessageListeners\UpdateButtonColour(
        new \BigButton\App\Colour\GoogleImagesLookupColourMap()
    )
);

$inboundMessageHandler->onTextMessageReceived($inboundMessage);
