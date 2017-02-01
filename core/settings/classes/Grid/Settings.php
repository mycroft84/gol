<?php
/**
 * User: MyCroft
 * Date: 15-01-14
 * Time: 10:19
 * Company: d2c
 */
class Grid_Settings extends Grid
{
    protected $tableName = "settings";

     protected function getDisabledFields() {
        return array();
    }

    protected function getDefaults() {
        return array(
            'order'=>'set_name',
            'orderDir'=>'asc',
            'limit'=>10
        );
    }

    protected function getDefaultFilters($joins = array())
    {
        return array(
            array(
                'column'=>'set_display',
                'rel'=>'=',
                'value'=>1
            )
        );
    }

	protected function enabledEdit()
    {
        return true;
    }
}