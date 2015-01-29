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

    function it_resolves_services()
    {
        $this['foo'] = function() {
            return 'asdf';
        };

        $this['foo']->shouldBeLike('asdf');
    }

    function it_resolves_services_once()
    {
	$uniqueId = '';
        $this['foo'] = function() use ($uniqueId) { 
            return $uniqueId = uniqid();
        };

        $this['foo']->shouldBeLike($this['foo']);
    }

    function it_resolves_services_only_once()
    {
        $this['foo'] = function() { return function() { return 'asdf'; }; };
        $this['foo']->shouldBeFunction();
        $this['foo']->shouldBeFunction();
    }

    public function getMatchers()
    {
        return [
            'beFunction' => function($subject) {
                return is_object($subject);
            },
        ];
    }
}
