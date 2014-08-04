<?php
namespace spec\MindOfMicah\Modules;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Illuminate\Filesystem\Filesystem;

class PathValidatorSpec extends ObjectBehavior
{
    public function let(Filesystem $f)
    {
        $this->beConstructedWith($f);
    }
    function it_is_initializable()
    {
        $this->shouldHaveType('MindOfMicah\Modules\PathValidator');
    }

    public function it_should_make_sure_the_needed_directories_exist(Filesystem $f)
    {
        $f->isDirectory('app/views/something')->willReturn(false)->shouldBeCalled();
        $f->makeDirectory('app/views/something', 0777, true)->shouldBeCalled();
        $this->validate('app/views/something/else.js');
    }
}
