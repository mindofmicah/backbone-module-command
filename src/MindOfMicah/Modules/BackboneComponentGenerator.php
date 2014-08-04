<?php
namespace MindOfMicah\Modules;

use Illuminate\Support\Collection;
use Illuminate\Support\Pluralizer;

class BackboneComponentGenerator
{
    public function generate($path, $name)
    {
        $singular = Pluralizer::singular($name); 
        $plural   = Pluralizer::plural($name); 

        $segments = explode('/', $path);
        $module_dir = array_pop($segments);

        return new Collection([
            'model' => new BackboneComponent(
                $path . '/' . $plural . '/models/' . $name . '.js', 
                $module_dir . '/' . $plural . '/models/' . $name, 
                ucfirst($singular)
            ),
            'view' => new BackboneComponent(
                $path . '/' . $plural . '/views/' . $singular . '_view.js', 
                $module_dir . '/' . $plural . '/views/' . $singular . '_view', 
                ucfirst($singular) . 'View'
            ),
            'collection' => new BackboneComponent(
                $path . '/' . $plural .'/collections/' .$plural .'.js', 
                $module_dir . '/' . $plural . '/collections/' . $plural, 
                ucfirst($singular) . 'Collection'
            ),
            'index' => new BackboneComponent(
                $path . '/' . $plural .'/index.js', 
                $module_dir . '/' . $plural . '/index', 
                'Index'
            ),
        ]);
        return new Collection($ret);;
    }
}
