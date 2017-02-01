<?php defined('SYSPATH') or die('No direct script access.');

class ORM_Nested_Sets extends Kohana_ORM_Nested_Sets {

    protected $is_nested_tree = true;

    public function delete($force_delete = false)
    {
        try
        {
            $this->_db->begin();

            $this->_and_scope(
                DB::delete($this->table_name())
                    ->where($this->_left_column, '>=', $this->{$this->_left_column})
                    ->and_where($this->_right_column, '<=', $this->{$this->_right_column})
            )->execute($this->_db);

            $first = $this->{$this->_right_column} + 1;
            $delta = $this->{$this->_left_column} - $this->{$this->_right_column} - 1;
            $this->_shift_rl_values($first, $delta, $this->{$this->_scope_column});

            $this->_db->commit();
        }
        catch (Exception $e)
        {
            $this->_db->rollback();
            throw $e;
        }

        return TRUE;
    }
}