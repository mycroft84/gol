<?php
/**
 * User: MyCroft
 * Date: 2013.09.05.
 * Time: 16:17
 * Project: d2cadmin3.3
 * Company: d2c
 */
class Kohana_Logging_Channels_User extends Kohana_Logging
{
    public $handlers = array('stream','mysql');
    public $channelName = 'user_log';

    public $additionalFields = array('user_id','username');

    public static function instance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new Logging_Channels_User();
        }

        return $inst;
    }
}