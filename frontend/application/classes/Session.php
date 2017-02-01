<?php defined('SYSPATH') OR die('No direct script access.');

abstract class Session extends Kohana_Session {

    public static $default = 'native';

    static function save_all($data)
    {
        if (!is_array($data)) return false;

        foreach($data as $key=>$value)
        {
            Session::instance()->set($key,$value);
        }

        return true;
    }

}
