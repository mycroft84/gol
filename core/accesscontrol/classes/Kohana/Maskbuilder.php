<?php
/**
 * User: MyCroft
 * Date: 2013.09.03.
 * Time: 10:19
 * Project: d2cadmin3.3
 * Company: d2c
 */
class Kohana_Maskbuilder
{
    const MASK_VIEW         = 1;          // 1 << 0
    const MASK_CREATE       = 2;          // 1 << 1
    const MASK_EDIT         = 4;          // 1 << 2
    const MASK_DELETE       = 8;          // 1 << 3
    const MASK_UNDELETE     = 16;         // 1 << 4
    const MASK_OPERATOR     = 32;         // 1 << 5
    const MASK_MASTER       = 64;         // 1 << 6
    const MASK_OWNER        = 128;        // 1 << 7

    private $mask = 0;

    public function _construct($mask = 0)
    {
        if (!is_integer($mask))
            throw new Exception("Contruct parameter must be integer!");

        $this->mask = $mask;
    }
    
    public function add($mask)
    {
        if (!defined('static::MASK_'.strtoupper($mask))) {
            throw new Exception('Maskbuilder parameter: '.$mask.' is not valid!');
        }

        $this->mask |= constant('static::MASK_'.strtoupper($mask));

        return $this;
    }

    public function get()
    {
        return $this->mask;
    }

    public function getPermissions($int = false)
    {
        if (!$int) $int = $this->get();

        return $this->convertIntToPermission($int);
    }

    private function convertIntToPermission($int)
    {
        $class = get_called_class();
        $ref = new ReflectionClass($class);
        $const = $ref->getConstants();

        $result = array();
        foreach($const as $index=>$item)
        {
            if ($int >= $item) $result[] = strtolower(str_replace('MASK_','',$index));
        }

        return $result;
    }
}