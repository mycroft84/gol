<?php
/**
 * User: MyCroft
 * Date: 15-01-07
 * Time: 13:44
 * Company: d2c
 */
class Details_Metadata extends Details
{
    protected function buttonsCustom()
    {
        return array();
    }

    protected function convertManyNames()
    {
        return array();
    }

    protected function createButtons()
    {
        return array();
    }

    protected function getDisabledFields()
    {
        return array();
    }

    protected function getDisabledAllDelete()
    {
        return array();
    }

    protected function orderBy()
    {
        return array();
    }

    protected function groupBy()
    {
        return array();
    }

    protected function getDisabledSection()
    {
        return array();
    }

    public function getEnabledEdit()
    {
        return true;
    }

    /*protected function getNameField($orm)
    {
        //echo Debug::vars($orm->table_name());

        switch($orm->table_name())
        {

            default:
                return parent::getNameField($orm);
        }
    }*/
}