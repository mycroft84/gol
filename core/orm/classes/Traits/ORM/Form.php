<?php
/**
 * User: Tibor
 * Date: 2015.08.24.
 * Time: 20:23
 * Project: enigma
 * Company: d2c
 */
trait Traits_ORM_Form
{
    public function getObjectValues()
    {
        return $this->_object;
    }

    public function isIsNestedTree()
    {
        return $this->is_nested_tree;
    }
}