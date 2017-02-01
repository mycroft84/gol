<?php
/**
 * User: Tibor
 * Date: 2014.02.27.
 * Time: 11:01
 * Project: panoramaapartman.eu
 * Company: d2c
 */
class Model_Files_Types extends ORM
{
    protected $_table_name = 'file_types';
    protected $_primary_key = 'ft_id';

    protected $_has_many = array(
        'files'=>array(
            'model'=>'Files',
            'through'=>'file_types_to_file',
            'foreign_key'=>'ft_id',
            'far_key'=>'fi_id'
        )
    );

}