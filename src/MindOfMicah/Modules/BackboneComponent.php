<?php
namespace MindOfMicah\Modules;

class BackboneComponent
{
    public $true_path;
    public $module_path;
    public $label;

    public function __construct($true_path, $module_path, $label)
    {
        $this->true_path = $true_path;
        $this->module_path = $module_path;
        $this->label = $label;
    }
}
