<?php
/**
 * User: Tibor
 * Date: 2013.09.05.
 * Time: 17:37
 * Project: d2cadmin3.3
 * Company: d2c
 */
class Kohana_Logging_Channels_System extends Kohana_Logging
{
    public $channelName = 'system';

    public static function instance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new Logging_Channels_System();
        }

        return $inst;
    }
}