<?php
namespace spec\MindOfMicah\Modules;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BackboneComponentGeneratorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('MindOfMicah\Modules\BackboneComponentGenerator');
    }

    public function it_should_generate_the_needed_info_for_creating_files()
    {
        $response = $this->generate('js/modules', 'taco');
        $response->shouldHaveType('Illuminate\Support\Collection');

        foreach(['model','view','collection', 'index'] as $index) {
            $response->get($index)->shouldHaveType('MindOfMicah\Modules\BackboneComponent');
        }
    }
}
