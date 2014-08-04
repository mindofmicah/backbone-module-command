<?php
namespace MindOfMicah\Modules;

use Illuminate\Support\Collection;
use Illuminate\Filesystem\Filesystem;
use Mustache_Engine;

abstract class BaseGenerator
{
    public function __construct(Filesystem $file, Mustache_Engine $mustache)
    {
        $this->file     = $file;
        $this->mustache = $mustache;
    }

    public function generate(BackboneComponent $component, $template, Collection $components)
    {
        $template = $this->file->get($template);
        
        $output = $this->mustache->render(
            $template, 
            $this->buildTemplateData($components)
        );

        $this->file->put($component->true_path, $output);
    }

    protected function buildTemplateData($components)
    {
        return [];
    }
}
