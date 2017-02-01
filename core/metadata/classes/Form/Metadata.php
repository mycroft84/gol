<?php
/**
 * User: MyCroft
 * Date: 15-01-07
 * Time: 13:44
 * Company: d2c
 */
class Form_Metadata extends Formbuilder
{

    public function fileUpload()
    {
        return array(
            'fileUpload'=>true,
            'onlyPic'=>true,
            'onlyOne'=>true,
            'enableDel'=>true,
        );
    }


    public function build(Formelements $elements) {
        $elements
            ->add('right','met_desc',null,array('class'=>''))
            ->add('right','met_keys',null,array('class'=>''))
            ->add('right','met_og_desc',null,array('class'=>''))
        ;
    }

}