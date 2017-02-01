<?php
/**
 * User: Tibor
 * Date: 2015.08.24.
 * Time: 18:58
 * Project: epu-check.at
 * Company: d2c
 */
trait Traits_ORM_Orders
{
    protected $orderField = null;
    protected $orderDependencies = array();

    /**
     * Update item order
     */
    private function updateOrder()
    {
        $reset = clone $this;
        $reset->clear();
        $orderField = $this->orderField;

        $original = $reset->where($this->primary_key(),'=',$this->pk())->find();
        $hasChange = false;

        if (!empty($this->orderDependencies)) {
            foreach($this->orderDependencies as $item)
            {
                $reset->where($item,'=',$this->$item);
                if ($original->$item != $this->$item) {
                    $hasChange = true;
                }
            }
        }

        if ($original->$orderField == $this->$orderField and $hasChange == false and !empty($this->$orderField)) {
            return false;
        }
        $max = $reset->count_all();

        if ($this->$orderField == "") {
            $this->$orderField = (int) $max + 1;
        }

        if ($this->$orderField > $max) {
            $order = ($this->pk() and !$hasChange) ? $max : $max + 1;
            $this->$orderField = $order;

            $start = $original->$orderField;
            $end = $order;

        } elseif ($this->$orderField < 1) {
            $order = 1;
            $this->$orderField = $order;

            $start = ($this->pk() and !$hasChange) ? $original->$orderField : $max;
            $end = $order;


        } else {
            $start = ($this->pk() and !$hasChange) ? $original->$orderField : $max;
            $end = $this->$orderField;
        }

        $this->updateOtherOrder($start,$end);

        if ($hasChange) {

            foreach($this->orderDependencies as $item)
            {
                $reset->where($item,'=',$original->$item);
                if ($this->_soft_delete_field) {
                    $reset->where($this->_soft_delete_field,'=',0);
                }
            }

            $max = $reset->count_all();

            $end = $max;
            $start = $original->$orderField;

            $this->updateOtherOrder($start,$end,$original);
        }
    }

    private function updateOrderAfterDelete()
    {
        $reset = clone $this;
        $reset->clear();

        if (!empty($this->orderDependencies)) {
            foreach($this->orderDependencies as $item)
            {
                $reset->where($item,'=',$this->$item);
                if ($this->_soft_delete_field) {
                    $reset->where($this->_soft_delete_field,'=',0);
                }
            }
        }
        $max = $reset->count_all();
        $orderField = $this->orderField;

        $this->updateOtherOrder($this->$orderField,$max);
    }

    private function updateOtherOrder($start,$end,$original = null)
    {
        $reset = clone $this;
        $reset->clear();
        $field = $this->orderField;

        if ($start < $end) {
            $from = $start;
            $to = $end;
            $increase = 1;
        } else {
            $from = $end;
            $to = $start;
            $increase = 0;
        }

        $op = ($increase) ? "-1" : "+1";

        $update = DB::update($this->table_name())
            ->set(array($field=>DB::expr($field.$op)));

        if (!empty($this->orderDependencies)) {
            foreach($this->orderDependencies as $item)
            {
                $target = ($original) ? $original->$item : $this->$item;
                $update->where($item,'=',$target);
            }
        }

        $update = $update->where($field,'BETWEEN',array($from,$to));
        if ($this->_soft_delete_field) {
            $update->where($this->_soft_delete_field,'=',0);
        }
        $update->execute();
        //echo Debug::vars(Database::instance()->last_query);

    }

	/**
     * @return ORM
     */
    public function setAllOrder()
    {
		if (!$this->orderField) return $this;
		
       $query = $this;
       foreach($this->orderDependencies as $item)
       {
           $query->order_by($item);
       }
       $query->order_by($this->orderField);

       if ($this->_soft_delete_field) {
           $query->where($this->_soft_delete_field,'=',0);
       }

       return $query;
    }
}