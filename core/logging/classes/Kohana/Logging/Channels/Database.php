<?php
/**
 * User: MyCroft
 * Date: 2013.09.05.
 * Time: 11:58
 * Project: d2cadmin3.3
 * Company: d2c
 */
class Kohana_Logging_Channels_Database extends Kohana_Logging
{
    public $channelName = 'database';

    public static function instance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new Logging_Channels_Database();
        }

        return $inst;
    }
}