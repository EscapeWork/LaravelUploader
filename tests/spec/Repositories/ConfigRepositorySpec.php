<?php

namespace spec\EscapeWork\LaravelUploader\Repositories;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConfigRepositorySpec extends ObjectBehavior
{

    function it_is_initializable()
    {
        $this->beConstructedWith([]);
        $this->shouldHaveType('EscapeWork\LaravelUploader\Repositories\ConfigRepository');
    }

    function it_should_objectify_simple_array()
    {
        $this->beConstructedWith(['item' => 'item1']);
        $this->item->shouldReturn('item1');
    }


    function it_should_objectify_multiple_array()
    {
        $array = [
            'item' => 'item1',
            'model' => [
                'item1' => 'foo',
                'item2' => 'bar',
                'medias' => [
                    'item1' => 'foo2',
                    'item2' => 'bar2',
                    'sizes' => [1, 2]
                ]
            ],
        ];
        $this->beConstructedWith($array);

        $this->item->shouldReturn('item1');
        
        $this->model->item1->shouldReturn('foo');
        $this->model->item2->shouldReturn('bar');

        $this->model->medias->item1->shouldReturn('foo2');
        $this->model->medias->item2->shouldReturn('bar2');

        $this->model->medias->sizes->shouldHaveCount(2);
    }

}
