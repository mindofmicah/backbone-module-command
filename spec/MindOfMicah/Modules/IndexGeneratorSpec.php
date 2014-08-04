<?php
namespace spec\MindOfMicah\Modules;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Illuminate\Filesystem\Filesystem;
use Mustache_Engine;
use MindOfMicah\Modules\Forms;
use MindOfMicah\Modules\BackboneComponent;
use Illuminate\Support\Collection;

class IndexGeneratorSpec extends ObjectBehavior
{
    public function let(Filesystem $f, Mustache_Engine $mustache)
    {
        $this->beConstructedWith($f, $mustache);
    }
    function it_is_initializable()
    {
        $this->shouldHaveType('MindOfMicah\Modules\IndexGenerator');
    }

    public function it_should_generate_a_module(Filesystem $filesystem, Mustache_Engine $mustache, Collection $c)
    {
        $filesystem->get('template.stub')->shouldBeCalled()->willReturn('template');
        $filesystem->put('js/modules/tacos/index.js', 'output')->shouldBeCalled();
        
        $mustache->render(
            'template', [
                'model_path'      => 'modules/tacos/models/taco',
                'model'           => 'Taco',
                'collection_path' => 'modules/tacos/collections/tacos', 
                'collection'      => 'TacoCollection',
                'view_path'       => 'modules/tacos/views/taco_view', 
                'view'            => 'TacoView',
            ]  
        )->shouldBeCalled()->willReturn('output');
        
        $c->get('model')->willReturn(new BackboneComponent('','modules/tacos/models/taco', 'Taco'))->shouldBeCalled();
        $c->get('view')->willReturn(new BackboneComponent('','modules/tacos/views/taco_view', 'TacoView'))->shouldBeCalled();
        $c->get('collection')->willReturn(new BackboneComponent('','modules/tacos/collections/tacos', 'TacoCollection'))->shouldBeCalled();

        $f = new BackboneComponent('js/modules/tacos/index.js', 'index', 'Index');
        $this->generate($f, 'template.stub', $c);
    }
}
