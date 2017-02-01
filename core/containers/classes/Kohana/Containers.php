<?php
/**
 * User: Tibor
 * Date: 2014.01.28.
 * Time: 17:53
 * Project: d2cadmin3.3
 * Company: d2c
 */
class Kohana_Containers
{
    public static function factory($name)
    {
        $className = "Containers_".ucfirst($name);
        return new $className;
    }
}