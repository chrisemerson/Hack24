<?php
namespace BigButton\App\Button;

use GuzzleHttp\Client;

class Button
{
    private static $url = "http://10.0.2.2:81/updatebuttoncolour.php";

    public function sendUpdate(ButtonUpdate $update)
    {
        $client = new Client();
        $request = $client->createRequest('POST', self::$url);

        $postBody = $request->getBody();

        $colour = $update->getColour();

        $postBody->setField('red', $colour->getRed());
        $postBody->setField('green', $colour->getGreen());
        $postBody->setField('blue', $colour->getBlue());

        $client->send($request);
    }
}
