<?php
/**
 * User: Tibor
 * Date: 2015.10.17.
 * Time: 16:17
 * Project: enigma
 * Company: d2c
 */
class Kohana_Restful_Exception extends HTTP_Exception
{
    public static function _401_exception($message = null)
    {
        $exception = HTTP_Exception::factory(401, $message);
        $exception->headers('www-authenticate', 'None');
        throw $exception;
    }

    public static function _404_exception($message = null)
    {
        $exception = HTTP_Exception::factory(404, $message);
        throw $exception;
    }
}