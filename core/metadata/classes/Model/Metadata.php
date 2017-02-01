<?php
/**
 * User: MyCroft
 * Date: 15-01-07
 * Time: 13:44
 * Company: d2c
 */
class Model_Metadata extends ORM
{
    protected $_table_name = 'metadata';
    protected $_primary_key = 'met_id';
	protected $form = 'metadata';

    protected $_translate_fields = array('met_title','met_desc','met_keys');

    public function rules()
    {
        return array(
            'met_url' => array(
                array('not_empty'),
            ),
            'met_title' => array(
                array('not_empty'),
            ),
        );
    }



}