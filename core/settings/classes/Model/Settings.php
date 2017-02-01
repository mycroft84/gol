<?php
/**
 * User: MyCroft
 * Date: 15-01-14
 * Time: 10:19
 * Company: d2c
 */
class Model_Settings extends ORM
{
    protected $_table_name = 'settings';
    protected $_primary_key = 'set_id';
	protected $form = 'settings';


    public function rules()
    {
        return array(
            'set_name' => array(
                array('not_empty'),
            ),
            'set_value' => array(
                array('not_empty'),
            ),
            'set_display' => array(
                array('not_empty'),
            ),
        );
    }



}