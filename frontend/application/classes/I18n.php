<?php defined('SYSPATH') or die('No direct script access.');

class I18n extends Kohana_I18n {


    public static function getSubtitles()
    {
        $subtitles = ORM::factory('languages')->find_all(I18n::$lang);

        $result = array();
        foreach($subtitles as $item)
        {
            $result[$item->stt_target] = $item->stt_text;
        }

        return $result;
    }
}
