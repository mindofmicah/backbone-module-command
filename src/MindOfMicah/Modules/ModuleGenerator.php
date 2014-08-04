<?php

namespace MindOfMicah\Modules;

class ModuleGenerator
{

    public function generate($c, $t)
    {
        $template  = $t->get('model');
        $component = $c->get('model');

        $this->pv->validate($component->true_path);
        $this->mg->generate($component, $template, $c);
        $template  = $t->get('view');
        $component = $c->get('view');
        $this->pv->validate($component->true_path);
        $this->vg->generate($component, $template, $c);
        $template  = $t->get('collection');
        $component = $c->get('collection');
        $this->pv->validate($component->true_path);
        $this->cg->generate($component, $template, $c);
        $template  = $t->get('index');
        $component = $c->get('index');
        $this->pv->validate($component->true_path);
        $this->ig->generate($component, $template, $c);



    }

    public function __construct(ModelGenerator $mg, ViewGenerator $vg, CollectionGenerator $cg, IndexGenerator $ig, PathValidator $pv)
    {
        $this->mg = $mg;
        $this->vg = $vg;
        $this->cg = $cg;
        $this->ig = $ig;
        $this->pv = $pv;
    }
}
