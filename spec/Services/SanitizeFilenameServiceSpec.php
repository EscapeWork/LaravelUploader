<?php

namespace spec\EscapeWork\LaravelUploader\Services;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SanitizeFilenameServiceSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('EscapeWork\LaravelUploader\Services\SanitizeFilenameService');
    }

    function it_should_format_files_without_extensions()
    {
        $this->execute('text')->shouldReturn('text');
    }

    function it_should_remove_special_chars()
    {
        $this->execute('çç.jpg')->shouldReturn('cc.jpg');
        $this->execute('test test.jpg')->shouldReturn('test-test.jpg');
    }

    function it_should_add_hifens_for_blanks()
    {
        $this->execute('çç à.jpg')->shouldReturn('cc-a.jpg');
    }

    function it_should_return_files_with_dots()
    {
        $this->execute('text.a')->shouldReturn('text.a');
        $this->execute('text.ab')->shouldReturn('text.ab');
    }

    function it_should_remove_dots()
    {
        $this->execute('file.name.extension')->shouldReturn('filename.extension');
    }

    function it_should_accept_hidden_files()
    {
        $this->execute('.hidden')->shouldReturn('.hidden');
    }

}
