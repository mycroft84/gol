<?php
/**
 * User: Tibor
 * Date: 2015.08.24.
 * Time: 19:20
 * Project: enigma
 * Company: d2c
 */
trait Traits_ORM_Defaultvalues
{
    protected $_created_by = false;
    protected $_updated_by = false;
    
    public function setDefaultValues()
    {
        if ($this->loaded()) {
            if (is_array($this->_updated_column))
            {
                // Fill the created column
                $column = $this->_updated_column['column'];
                $format = $this->_updated_column['format'];

                $this->$column = ($format === TRUE) ? time() : date($format);
            }

            if (is_array($this->_updated_by))
            {
                $column = $this->_updated_by['column'];
                $this->$column = Auth::instance()->get_user()->id;
            }

        } else {
            if (is_array($this->_created_column))
            {
                // Fill the created column
                $column = $this->_created_column['column'];
                $format = $this->_created_column['format'];

                $this->$column = ($format === TRUE) ? time() : date($format);
            }

            if (is_array($this->_created_by))
            {
                $column = $this->_created_by['column'];
                $this->$column = Auth::instance()->get_user()->id;
            }
        }
    }
}