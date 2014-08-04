<?php
namespace MindOfMicah\Modules;

class IndexGenerator extends BaseGenerator
{
    protected function buildTemplateData($collection)
    {
        return [
            'model_path'      => $collection->get('model')->module_path, 
            'model'           => $collection->get('model')->label,
            'collection_path' => $collection->get('collection')->module_path,
            'collection'      => $collection->get('collection')->label,
            'view_path'       => $collection->get('view')->module_path,
            'view'            => $collection->get('view')->label,
        ];
    }
}
