<?php
require_once "../vendor/autoload.php";

$clickHandler = new \BigButton\App\Button\ClickHandler();

$clickHandler->registerListener(new \BigButton\App\ButtonListeners\SendNextEventTextMessageListener());

$clickHandler->onButtonPress();
