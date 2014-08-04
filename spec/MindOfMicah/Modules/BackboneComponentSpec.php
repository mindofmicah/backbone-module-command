<?php

namespace spec\MindOfMicah\Modules;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BackboneComponentSpec extends ObjectBehavior
{
    public function it_should_be_a_simple_dto()
    {
        $this->beConstructedWith('real_path', 'module_path', 'label');
        $this->true_path->shouldBe('real_path');
        $this->module_path->shouldBe('module_path');
        $this->label->shouldBe('label');
    }
}
