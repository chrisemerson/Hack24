<?php
namespace spec\BigButton\App\Button;

use BigButton\App\Exceptions\InvalidColourValueException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ColourSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(0, 0, 0);
        $this->shouldHaveType('BigButton\App\Button\Colour');
    }

    function it_should_store_and_return_colours_as_int_values()
    {
        $red = 123;
        $green = 231;
        $blue = 99;

        $this->beConstructedWith($red, $green, $blue);

        $this->getRed()->shouldBe($red);
        $this->getGreen()->shouldBe($green);
        $this->getBlue()->shouldBe($blue);
    }

    function it_should_reject_invalid_red_colour_value()
    {
        $validColour = 123;
        $invalidColour = 543;


        $this
            ->shouldThrow(
                new InvalidColourValueException(
                    "Invalid Red value '" . $invalidColour . "' - Must be an int between 0 and 255"
                )
            )->during(
                '__construct',
                [
                    $invalidColour,
                    $validColour,
                    $validColour
                ]
            );
    }

    function it_should_reject_invalid_green_colour_value()
    {
        $validColour = 123;
        $invalidColour = 543;

        $this
            ->shouldThrow(
                new InvalidColourValueException(
                    "Invalid Green value '" . $invalidColour . "' - Must be an int between 0 and 255"
                )
            )->during(
                '__construct',
                [
                    $validColour,
                    $invalidColour,
                    $validColour
                ]
            );
    }

    function it_should_reject_invalid_blue_colour_value()
    {
        $validColour = 123;
        $invalidColour = 543;

        $this
            ->shouldThrow(
                new InvalidColourValueException(
                    "Invalid Blue value '" . $invalidColour . "' - Must be an int between 0 and 255"
                )
            )->during(
                '__construct',
                [
                    $validColour,
                    $validColour,
                    $invalidColour
                ]
            );
    }
}
