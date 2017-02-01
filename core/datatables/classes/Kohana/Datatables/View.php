<?php
/**
 * User: Tibor
 * Date: 2014.03.21.
 * Time: 10:28
 * Project: d2cadmin3.3
 * Company: d2c
 */
class Kohana_Datatables_View
{
    public $columns = array();
    public $renderMode = "dom";
    public $target;
    public $records;

    public static function factory()
    {
        $view = new Datatables_View();
        return $view;
    }
}