<?php
namespace spec\MindOfMicah\Modules;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Mustache_Engine;
use MindOfMicah\Modules\BackboneComponent;

class ViewGeneratorSpec extends ObjectBehavior
{
    public function let(Filesystem $f, Mustache_Engine $mustache)
    {
        $this->beConstructedWith($f, $mustache);
    }
    function it_is_initializable()
    {
        $this->shouldHaveType('MindOfMicah\Modules\viewGenerator');
    }

    public function it_should_generate_a_view(Filesystem $filesystem, Mustache_Engine $mustache, Collection $components)
    {
        $filesystem->get('template.stub')->shouldBeCalled()->willReturn('template');
        $mustache->render('template', [])->shouldBeCalled()->willReturn('output');
        $filesystem->put('js/modules/tacos/views/taco_view.js', 'output')->shouldBeCalled();

        $component = new BackboneComponent(
            'js/modules/tacos/views/taco_view.js', 
            'modules/tacos/views/taco_view',
            'TacoView'
        );

        $this->beConstructedWith($filesystem, $mustache);

        $this->generate($component,  'template.stub', $components);
    }
}
