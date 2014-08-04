<?php

namespace spec\MindOfMicah\Modules;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Mustache_Engine;

use MindOfMicah\Modules\BackboneComponent;

class ModelGeneratorSpec extends ObjectBehavior
{
    public function let(Filesystem $f, Mustache_Engine $mustache)
    {
        $this->beConstructedWith($f, $mustache);
    }
    function it_is_initializable()
    {
        $this->shouldHaveType('MindOfMicah\Modules\ModelGenerator');
    }

    public function it_should_generate_a_model(Filesystem $filesystem, Mustache_Engine $mustache)
    {
        $filesystem->get('template.stub')->shouldBeCalled()->willReturn('template');
        $mustache->render('template', [])->shouldBeCalled()->willReturn('output');
        $filesystem->put('js/modules/tacos/models/taco.js', 'output')->shouldBeCalled();

        $f = new BackboneComponent('js/modules/tacos/models/taco.js', 'real', 'label');
        $this->beConstructedWith($filesystem, $mustache);
        $path = 'js/modules/';

        $this->generate($f,  'template.stub', new Collection);
    }
}
