<?php
namespace BigButton\App\TextMessage;

class InboundMessageFactory
{
    public function constructFromXML($xml)
    {
        $simpleXML = simplexml_load_string($xml);

        $from = (String) $simpleXML->From;
        $message = (String) $simpleXML->MessageText;

        return new InboundMessage($message, $from);
    }
}
