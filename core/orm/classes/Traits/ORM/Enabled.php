<?php

/**
 * User: Tibor
 * Date: 2015.08.24.
 * Time: 18:52
 * Project: enigma
 * Company: d2c
 */
trait Traits_ORM_Enabled
{
    protected $enabledField = null;

	/**
     * @return ORM
     */
    public function setEnabled()
    {
		if (!$this->enabledField) return $this;
		
        return $this->where($this->enabledField,'=',1);
    }
	
	public function isEnabled()
    {
	    if (!$this->enabledField) return false;

	    return (bool) $this->{$this->enabledField};
    }
}