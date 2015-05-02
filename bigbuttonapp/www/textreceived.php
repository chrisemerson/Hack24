<?php
require_once "../vendor/autoload.php";

$data = file_get_contents("php://input");

$inboundMessageFactory = new \BigButton\App\TextMessage\InboundMessageFactory();
$inboundMessage = $inboundMessageFactory->constructFromXML($data);

$inboundMessageHandler = new \BigButton\App\TextMessage\InboundMessageHandler();

//Register listeners here

$inboundMessageHandler->onTextMessageReceived($inboundMessage);