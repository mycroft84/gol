<?php
/**
 * User: Tibor
 * Date: 2015.08.24.
 * Time: 20:19
 * Project: enigma
 * Company: d2c
 */
trait Traits_ORM_Utility
{
    protected $schema = array();
	protected $binding = null;

    public function convertForSelect(array $names)
    {
        $query = $this->find_all(I18n::$lang);

        $result = array();
       foreach($query as $item)
       {
           $nameColumns = array();
           foreach($names as $n)
           {
               $nameColumns[] = $item->$n;
           }

           $result[] = array(
               'name'=>join(' ',$nameColumns),
               'value'=>$item->pk()
           );
       }

       return $result;
    }

    public function removeFromChangedList($index)
    {
        unset($this->_changed[$index]);
    }


    public function getLastQueries() {
        return $this->queries;
    }

    public function getNamesFields()
    {
        $result = array();
        $fields = Database::instance()->list_columns($this->table_name());
        $firstString = false;

        foreach($fields as $index=>$value)
        {
            if ($index != 'username') {
                if (strpos($index,'name') !== false or strpos($index,'title') !== false) {
                    $result[] = $index;
                }
            }

            if ($value['type'] == 'string' and $firstString == false) $firstString = $index;
        }

        if (empty($result)) {
            $result = array($firstString);
        }

        return $result;
    }
    
    public function getForJson()
    {
        $result = $this->as_array();
        $result = $this->changeColumnForSchema($result);

        $files = $this->getImagesForJson();
        if (!empty($files)) {
            $result['files'] = $files;
        }

        return $result;
    }

    public function getAllForJson()
    {
        $result = array();
        foreach($this->find_all() as $item) {
            $result[] = $item->getForJson();
        }

        return $result;
    }

    public function getImagesForJson()
    {
        $files = array();
        foreach ($this->getFiles()->getAll() as $block) {
            foreach ($block as $item) {
                $type = $item->types->find();
                $files[] = array(
                    'id'=>$item->fi_id,
                    'type' => $type->ft_tag,
                    'url'=>Kohana::$config->load('settings.userfilesUrl') . $item->fi_url,
                    'thumbs'=>$item->getThumbs()->getAllThumbs()
                );
            }
        }

        return $files;
    }

    protected function changeColumnForSchema($result)
    {
        if (empty($this->schema)) return $result;

        foreach ($result as $index => $value) {
           if (isset($this->schema[$index])) {
               $result[$this->schema[$index]] = $value;
           }
           unset($result[$index]);
        }

        return $result;
    }
	
	public function addMultiValue($rel,$data)
    {
        $this->clearRel($rel);

        if (isset($data[$rel])) {
            foreach ($data[$rel] as $item) {
                if ($item != -1) {
                    $this->add($rel,$item);
                }
            }
        }
    }

	public function clearRel($rel)
    {
        foreach ($this->$rel->getAll() as $item) {
            $this->remove($rel,$item->pk());
        }
    }

	public function getRelIds($relation)
    {
        $result = array();
        foreach ($this->$relation->getAll() as $item) {
            $result[] = $item->pk();
        }

        return $result;
    }

    public function getBinding()
    {
        if ($this->binding) return $this->binding;

        return $this->primary_key();
    }
}