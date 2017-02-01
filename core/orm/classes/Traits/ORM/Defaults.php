<?php
/**
 * User: Tibor
 * Date: 2015.08.24.
 * Time: 19:06
 * Project: enigma
 * Company: d2c
 */
trait Traits_ORM_Defaults
{
    protected $defaultField = null;
    protected $defaultDependencies = array();

    public function setDefaultFieldValue()
    {
        if ($this->defaultField and $this->{$this->defaultField} == 1) {
            $query = DB::update($this->table_name())
                ->set(array($this->defaultField=>0))
                ->where($this->primary_key(),'!=',$this->pk());

            if (!empty($this->defaultDependencies)) {
                foreach ($this->defaultDependencies as $item)
                {
                    $query->where($item,'=',$this->$item);
                }
            }

            $query->execute();
        }
    }

    public function getDefaultRow($deps = array())
    {
        $query = $this->where($this->defaultField,'=',1);
        if (!empty($deps)) {
            foreach ($deps as $dep=>$value) {
                $query->where($dep,'=',$value);
            }
        }

        return $query->find();
    }
}