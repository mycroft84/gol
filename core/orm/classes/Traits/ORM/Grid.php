<?php
/**
 * User: Tibor
 * Date: 2015.08.24.
 * Time: 20:22
 * Project: enigma
 * Company: d2c
 */
trait Traits_ORM_Grid
{
    public function getBeto($name)
    {
        return (isset($this->_belongs_to[$name])) ? $this->_belongs_to[$name] : array();
    }
}