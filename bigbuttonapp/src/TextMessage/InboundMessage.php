<?php
namespace BigButton\App\TextMessage;

class InboundMessage
{
    /** @var string */
    private $messageText;

    /** @var string */
    private $from;

    function __construct($messageText, $from)
    {
        $this->messageText = $messageText;
        $this->from = $from;
    }

    /** @return string */
    public function getMessageText()
    {
        return $this->messageText;
    }

    /** @return string */
    public function getFrom()
    {
        return $this->from;
    }
}
