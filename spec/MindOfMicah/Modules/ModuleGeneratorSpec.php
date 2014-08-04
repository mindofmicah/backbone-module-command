<?php
namespace spec\MindOfMicah\Modules;

use Illuminate\Support\Collection;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use MindOfMicah\Modules\ModelGenerator;
use MindOfMicah\Modules\ViewGenerator;
use MindOfMicah\Modules\CollectionGenerator;
use MindOfMicah\Modules\IndexGenerator;
use MindOfMicah\Modules\BackboneComponent;
use MindOfMicah\Modules\PathValidator;

class ModuleGeneratorSpec extends ObjectBehavior
{
    public function let(ModelGenerator $mg, ViewGenerator $vg, CollectionGenerator $cg, IndexGenerator $ig, PathValidator $pv)
    {
        $this->beConstructedWith($mg, $vg, $cg, $ig, $pv);
    }
    function it_is_initializable()
    {
        $this->shouldHaveType('MindOfMicah\Modules\ModuleGenerator');
    }
        
    public function it_should_generate_the_backbone_components(ModelGenerator $mg, ViewGenerator $vg, CollectionGenerator $cg, IndexGenerator $ig, Collection $c, Collection $templates, PathValidator $pv)
    {
        $model_component = new BackboneComponent(
            'js/modules/tacos/models/taco.js', 
            'modules/tacos/models/taco', 
            'Taco'
        );
        $view_component = new BackboneComponent(
            'js/modules/tacos/views/taco_view.js', 
            'modules/tacos/views/taco_view',
            'TacoView'
        );
        $collection_component = new BackboneComponent(
            'js/modules/tacos/collections/tacos.js', 
            'modules/tacos/collections/tacos', 
            'TacoCollection'
        );
        $index_component = new BackboneComponent(
            'js/modules/tacos/index.js', 
            'modules/tacos/index', 
            'Index'
        );

        $c->get('model')->willReturn($model_component);
        $c->get('view')->willReturn($view_component);
        $c->get('collection')->willReturn($collection_component);
        $c->get('index')->willReturn($index_component);

        $pv->validate('js/modules/tacos/models/taco.js')->shouldBeCalled();
        $pv->validate('js/modules/tacos/collections/tacos.js')->shouldBeCalled();
        $pv->validate('js/modules/tacos/views/taco_view.js')->shouldBeCalled();
        $pv->validate('js/modules/tacos/index.js')->shouldBeCalled();

        $templates->get('model')->willReturn('model.template')->shouldBeCalledTimes(1);
        $templates->get('view')->willReturn('view.template')->shouldBeCalledTimes(1);
        $templates->get('collection')->willReturn('collection.template')->shouldBeCalledTimes(1);
        $templates->get('index')->willReturn('index.template')->shouldBeCalledTimes(1);

        $mg->generate($model_component, 'model.template', $c)->shouldBeCalledTimes(1);
        $vg->generate($view_component, 'view.template', $c)->shouldBeCalledTimes(1);
        $cg->generate($collection_component, 'collection.template', $c)->shouldBeCalledTimes(1);
        $ig->generate($index_component, 'index.template', $c)->shouldBeCalledTimes(1);

        $this->generate($c, $templates);
    }
}
