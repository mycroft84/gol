<?php
/**
 * User: Tibor
 * Date: 2015.08.24.
 * Time: 20:13
 * Project: enigma
 * Company: d2c
 */
trait Traits_ORM_Delete
{

    public function delete($force_delete = false)
    {
        if ($this->_soft_delete_field and $force_delete == true) {
            return $this->softDelete();
        }

        /*$langTable = $this->_table_name."_languages";
        $prefix = substr($this->_table_name,0,2);
        $hasLangTable = (bool) count(Database::instance()->list_tables($langTable));

        //Delete lang records
        if ($hasLangTable) {
            DB::delete($langTable)->where($prefix.'l_ref_id','=',$this->pk())->execute();
        }*/

        //Delete files
        if ($this->table_name() != 'files')
            ORM::factory('files')->delTableItem($this->_table_name,$this->pk());

        try {
            if ($this->orderField) {
                $this->updateOrderAfterDelete();
            }

            $this->logChanges();

            parent::delete();

            return array('error'=>false);
        } catch (ORM_Validation_Exception $e) {
            return array('error'=>true,'messages'=>$e->errors($this->_validation_dir),'lang'=>$e->getLang());
        }
    }

    public function delByPk($id)
    {
        try{
            if ($this->_soft_delete_field) {
                $del = DB::update($this->table_name())
                    ->set(array($this->_soft_delete_field=>1))
                    ->where($this->primary_key(),(is_array($id)) ? 'IN' : '=',$id)
                    ->execute();
            } else {
                $ids = (is_array($id)) ? $id : array($id);

                foreach ($ids as $item) {
                    $this->clear();
                    $orm = $this->where($this->primary_key(),'=',$item)->find();
                    if ($orm->loaded()) {
                        $orm->delete();
                    }
                }

            }


            return array('error'=>false);

        } catch(Exception $e) {
            return array('error'=>true);
        }

    }
}