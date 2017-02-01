<?php
/**
 * User: Tibi
 * Date: 2014.07.16.
 * Time: 11:14
 * Project: zalanka.hu
 * Company: d2c
 */
class Kohana_GPS
{
    const LAT = 0;
    const LNG = 1;

    public static function convertDegreesToDecimal($degrees)
    {
        $type = self::getType($degrees);

        if ($type != -1) {
            $dir = self::getDir($degrees);
            $number = self::getNumber($degrees);

            return $dir * $number;
        }

        return $degrees;
    }

    private static function getType($degrees)
    {
        if (strpos($degrees,'N') !== false || strpos($degrees,'S') !== false) {
            return self::LAT;
        }

        if (strpos($degrees,'E') !== false || strpos($degrees,'W') !== false) {
            return self::LNG;
        }

        return -1;
    }

    private static function getDir($degrees)
    {
        if (strpos($degrees,'N') !== false || strpos($degrees,'E') !== false) {
            return 1;
        }

        if (strpos($degrees,'S') !== false || strpos($degrees,'W') !== false) {
            return -1;
        }
    }

    private static function getNumber($degrees)
    {
        $degrees = trim(str_replace(array('N','E','W','S'),array('','','',''),$degrees));
        $parts = explode(' ',$degrees);

        return (int) $parts[0] + ($parts[1] / 60);
    }
}