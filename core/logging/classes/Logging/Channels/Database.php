<?php
/**
 * User: MyCroft
 * Date: 2013.09.05.
 * Time: 11:58
 * Project: d2cadmin3.3
 * Company: d2c
 */
class Logging_Channels_Database extends Kohana_Logging_Channels_Database {

    CONST CREATE = 'Create';
    CONST UPDATE = 'Update';
    CONST DELETE = 'Delete';

    public $channelName = 'database_changes';
    public $handlers = array('stream','mysql');
    public $additionalFields = array('table','before','after');

    public function changes($type,$table,array $before,array $after)
    {
        Logging_Channels_Database::instance()->addInfo($type,array(
            'table'=>$table,
            'before'=>json_encode($before),
            'after'=>json_encode($after)
        ));
    }
}