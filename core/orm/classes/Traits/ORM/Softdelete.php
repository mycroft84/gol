<?php
/**
 * User: Tibor
 * Date: 2015.08.24.
 * Time: 19:22
 * Project: enigma
 * Company: d2c
 */
trait Traits_ORM_Softdelete
{
    protected $_soft_delete_field = null;

    public function softDelete()
    {
        try {

            $delfield = $this->_soft_delete_field;
            $this->$delfield = 1;
            $this->save();

            return array('error'=>false);

        } catch (ORM_Validation_Exception $e) {
            return array('error'=>true,'messages'=>$e->errors($this->_validation_dir),'lang'=>$e->getLang());
        }
    }

    public function withTrash()
    {
        $this->_soft_delete_field = null;
        return $this;
    }

    public function softUndelete()
    {
        $this->{$this->_soft_delete_field} = 0;
        $this->save();

        return $this;
    }

    protected function withoutSoftDeleteItems()
    {
        $this->where($this->_soft_delete_field,'=',0);
    }
}