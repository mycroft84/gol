<?php
/**
 * User: MyCroft
 * Date: 15-01-14
 * Time: 10:19
 * Company: d2c
 */
class Form_Settings extends Formbuilder
{


    public function build(Formelements $elements) {

        if (!Auth::instance()->hasRole('developer')) {
            $elements
                ->add('right', 'set_name', null, array('class' => '', 'readonly' => true))
                ->add('right', 'set_value', null, array('class' => ''))
                ->add('right', 'set_display', null, array('render' => false))
                ->add('right', 'set_add_js', null, array('render' => false));
        }
    }

}