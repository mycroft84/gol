<?php defined('SYSPATH') OR die('No direct script access.');

class Valid extends Kohana_Valid
{

    public static function not_empty_select($value)
    {
        if (is_object($value) AND $value instanceof ArrayObject)
        {
            // Get the array from the ArrayObject
            $value = $value->getArrayCopy();
        }

        // Value cannot be NULL, FALSE, '', or an empty array
        return !(in_array($value, array(NULL, FALSE, '', array()), TRUE) || $value == -1);
    }

    public static function is_checked($value)
    {
        return $value == 1;
    }

    public static function custom_not_empty()
    {
        $fparams = func_get_args();
        $params = end($fparams);
        unset($fparams[count($fparams)-1]);

        return call_user_func_array($params,$fparams);
    }

}
