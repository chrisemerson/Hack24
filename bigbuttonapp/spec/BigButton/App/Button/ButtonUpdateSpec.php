<?php
namespace spec\BigButton\App\Button;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ButtonUpdateSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('BigButton\App\Button\ButtonUpdate');
    }
}
