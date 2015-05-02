<?php
namespace BigButton\App\Button;

class ClickHandler
{
    /** @var ButtonListener[] */
    private $listeners = [];

    public function registerListener(ButtonListener $listener)
    {
        $this->listeners[] = $listener;
    }

    public function onButtonPress()
    {
        foreach ($this->listeners as $listener) {
            $listener->onButtonPress();
        }
    }
}
