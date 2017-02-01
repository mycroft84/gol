<?php
/**
 * User: MyCroft
 * Company: design2code.hu
 * Product: d2cadmin
 * Date: 2013.05.11.
 * Time: 11:29
 */
class Model_Board_Alives extends ORM {

    protected $_table_name = 'board_alives';
    protected $_primary_key = 'boal_id';

    protected $_belongs_to = array(
        'board'=>array(
            'model'=>'Board',
            'foreign_key'=>'boal_bo_id'
        )
    );
}