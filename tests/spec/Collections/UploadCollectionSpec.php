<?php

namespace spec\EscapeWork\LaravelUploader\Collections;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UploadCollectionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('EscapeWork\LaravelUploader\Collections\UploadCollection');
    }

    function it_should_return_first_name_item()
    {
        $this->beConstructedWith([['name' => 'foo'], ['name' => 'bar']]);
        $this->__toString()->shouldReturn('foo');
    }

    function it_should_return_first_item_when_name_doesnt_exist()
    {
        $this->beConstructedWith(['foo', 'bar']);
        $this->__toString()->shouldReturn('foo');
    }
}
