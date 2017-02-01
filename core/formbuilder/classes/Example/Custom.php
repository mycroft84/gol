<?php
/**
 * User: MyCroft
 * Date: 2013.08.23.
 * Time: 14:03
 * Project: d2cadmin3.3
 * Company: d2c
 */
class Form_Custom extends Formbuilder
{
    public $hasLang = false;
    public $table = 'news';

    public $tabs = array(
        'index'=>'valami',
        'index2'=>'valami2'
    );

    public function fileUpload() {
        return array(
            'fileUpload'=>true,
            'onlyPic'=>true,
            'onlyOne'=>true
        );
    }

    protected function related_option_sort()
    {
        return array(
            'users'=>array(
                'field'=>DB::expr('CONCAT_WS(" ",first_name,last_name)'),
                'order'=>'asc'
            )
        );
    }
    public function rules()
    {
        return array(
            'ga_email' => array(
                array('not_empty'),
                array('email')
            ),
            'ga_password' => array(
                array('not_empty'),
            )
        );
    }

    public function build(Formelements $elements) {

        $options = array(
            array(
                'value'=>'1',
                'name'=>'valami'
            )
        );

        $elements
            ->add('right','ne_lead','textarea')
            ->add('left','ne_created_at','input',array('type'=>'checkbox','tab'=>'index'))
            ->add('left','ne_updated_at','select',array('value'=>1,'options'=>$options))
            ->add('left','ne_created_by','input')
            ->add('left','ne_updated_by','input');
    }
}