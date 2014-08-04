<?php
namespace MindOfMicah\Modules;

class CollectionGenerator extends BaseGenerator
{
    protected function buildTemplateData($components)
    {
        return [
            'model_path' => $components->get('model')->module_path,
            'model'      => $components->get('model')->label
        ];
    }
}
