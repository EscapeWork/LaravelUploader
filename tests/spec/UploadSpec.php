<?php

namespace spec\EscapeWork\LaravelUploader;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Illuminate\Contracts\Bus\Dispatcher;
use EscapeWork\LaravelUploader\Repositories\ConfigRepository;

class UploadSpec extends ObjectBehavior
{
    function let(Dispatcher $dispatcher, ConfigRepository $config)
    {
        $config->dir = '';
        $this->beConstructedWith($dispatcher, $config);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('EscapeWork\LaravelUploader\Upload');
    }

    function it_should_return_itself_when_dir_is_set()
    {
        $this->to('')->shouldReturnAnInstanceOf('EscapeWork\LaravelUploader\Upload');
        $this->to(null)->shouldReturnAnInstanceOf('EscapeWork\LaravelUploader\Upload');
    }

    function it_should_throw_exception_when_dir_is_null()
    {
        $this->shouldThrow('EscapeWork\LaravelUploader\Exceptions\UploadSettingsException')->during('execute', ['foo']);
    }

}
