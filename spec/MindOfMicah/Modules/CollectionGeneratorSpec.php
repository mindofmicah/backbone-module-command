<?php

namespace spec\MindOfMicah\Modules;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Mustache_Engine;
use MindOfMicah\Modules\Forms;
use MindOfMicah\Modules\BackboneComponent;

class CollectionGeneratorSpec extends ObjectBehavior
{
    public function let(Filesystem $f, Mustache_Engine $mustache)
    {
        $this->beConstructedWith($f, $mustache);
    }
    function it_is_initializable()
    {
        $this->shouldHaveType('MindOfMicah\Modules\CollectionGenerator');
    }

    public function it_should_generate_a_collection(Filesystem $filesystem, Mustache_Engine $mustache, Collection $c)
    {
        $filesystem->get('template.stub')->shouldBeCalled()->willReturn('template');
        $mustache->render(
            'template', 
            ['model_path' => 'modules/tacos/models/taco', 'model'=>'Taco']
        )->shouldBeCalled()->willReturn('output');

        $filesystem->put('js/modules/tacos/collections/tacos.js', 'output')->shouldBeCalled();

        $c->get('model')->willReturn(new BackboneComponent('path','modules/tacos/models/taco', 'Taco'))->shouldBeCalled();
        $f = new BackboneComponent('js/modules/tacos/collections/tacos.js', 'tacos/tacos', 'TacoCollection');
        $this->beConstructedWith($filesystem, $mustache);
        $path = 'js/modules/';

        $this->generate($f,  'template.stub', $c);
    }
}
