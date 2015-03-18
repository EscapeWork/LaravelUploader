<?php

namespace spec\EscapeWork\LaravelUploader\Services;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ValidateFilenameServiceSpec extends ObjectBehavior
{

    function let(\Illuminate\Filesystem\Filesystem $filesystem)
    {
        $this->beConstructedWith($filesystem);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('EscapeWork\LaravelUploader\Services\ValidateFilenameService');
    }

    function it_should_not_change_file_that_doesnt_exist($filesystem)
    {
        $basepath = 'foo/bar';
        $filename = 'filename.exe';

        $filesystem->extension($filename)->willReturn('exe');
        $filesystem->exists($basepath . '/' . $filename)->willReturn(false);

        $this->execute($basepath, $filename)->shouldReturn($filename);
    }

    function it_should_change_file_when_it_exists($filesystem)
    {
        $basepath = 'foo/bar';
        $filename = 'filename.exe';
        $expected = 'filename-1.exe';

        $filesystem->extension($filename)->willReturn('exe');
        $filesystem->exists($basepath . '/' . $filename)->willReturn(true);
        $filesystem->exists($basepath . '/' . $expected)->willReturn(false);

        $this->execute($basepath, $filename)->shouldReturn($expected);
    }


}
