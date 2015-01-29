<?php

namespace spec\Helios;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ContainerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Helios\Container');
    }

    function it_works_like_an_array()
    {
        $this['asdf'] = 'fdsa';
        $this->shouldHaveKey('asdf');
        $this['asdf']->shouldBeLike('fdsa');
    }
}
