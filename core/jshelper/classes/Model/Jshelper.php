<?php

class Model_Jshelper extends Model
{
    static function getRouting()
    {
        return Route::uris();
    }

    static function json_encode($data)
    {
        $result = array();
        foreach($data as $item)
        {
            $result[] = $item->as_array();
        }

        return $result;
    }
}