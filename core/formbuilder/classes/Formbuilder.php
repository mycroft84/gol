<?php

class Formbuilder extends Kohana_Formbuilder
{
    protected function addCustomDefaultFields()
    {
        if (Input::get('select')) {
            $this->elements->add('left','parent_select','input',array('value'=>Input::get('select'),'type'=>'hidden'));
        }
    }
}