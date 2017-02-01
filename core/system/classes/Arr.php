<?php defined('SYSPATH') OR die('No direct script access.');

class Arr extends Kohana_Arr {

	static function DBQueryConvertSingleArray($array)
    {
        $result = array();
        foreach($array as $item)
        {
            foreach($item as $element)
            {
                $result[] = $element;
            }
        }
        
        return $result;
    }

	public static function DBResultExtend(array $result, array $filters)
    {
        $filtersKeys = array_keys($filters);
        $filtersValue = array();
        $filtersPairs = array();

        foreach($result as $index=>$item)
        {
            foreach($filtersKeys as $key)
            {
                $filtersValue[$key][] = $item[$key];
                $filtersPairs[$key][$item[$key]][] = $index;
            }
        }

        foreach($filtersValue as $index=>$value)
        {
            foreach ($filters[$index] as $callbacks)
            {
                $filterResult = $callbacks['callback']($value);
                foreach($filterResult as $fIndex=>$fValue)
                {
                    foreach($filtersPairs[$index][$fIndex] as $fpIndex=>$fpValue)
                    {
                        if (isset($callbacks['add']) and $callbacks['add'])
                        {
                            $result[$fpValue][$callbacks['add']] = $fValue;
                        } else {
                            $result[$fpValue][$index] = $fValue;
                        }

                    }
                }
            }

            //echo Debug::vars($index,$filterResult);
        }

        return $result;
    }

    public static function insert($array, $index, $value)
    {
        $result = array();
        foreach ($array as $i => $v) {
            if ($i<$index) {
                $result[] = $v;
            } elseif ($i == $index) {
                $result[] = $value;
                $result[] = $v;
            } else {
                $result[] = $v;
            }
        }
		
		if (count($array) == 0) $result[] = $value;

        return $result;
    }

}