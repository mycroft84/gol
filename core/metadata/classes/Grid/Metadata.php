<?php
/**
 * User: MyCroft
 * Date: 15-01-07
 * Time: 13:44
 * Company: d2c
 */
class Grid_Metadata extends Grid
{
    protected $tableName = "metadata";

     protected function getDisabledFields() {
        return array();
    }

    protected function getDefaults() {
        return array(
            'order'=>'met_title',
            'orderDir'=>'asc',
            'limit'=>10
        );
    }
}