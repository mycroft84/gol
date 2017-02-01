<?php
/**
 * User: Tibor
 * Date: 2015.08.24.
 * Time: 20:06
 * Project: enigma
 * Company: d2c
 */
trait Traits_ORM_Searchable
{
    public function find($lang = null)
    {
        $defaultLang = current(Kohana::$config->load('settings.frontendLangs'));
        if (!$lang) {
            $requestLang = ORM::factory('languages')->getRequestLang(Request::$current);
            $lang = $requestLang['lang'];
        }

        if ($this->_soft_delete_field) {
            $this->withoutSoftDeleteItems();
        }

        $this->currentLang = $lang;
        if ($defaultLang == $lang) {
            parent::find();
        } else {
            $this->changeRecordLang($lang);
        }

        return $this;
    }

    public function find_all($lang = null)
    {
        if ($this->_soft_delete_field) {
            $this->withoutSoftDeleteItems();
        }

        if (!$lang) {
            $records = parent::find_all()->as_array();
            $this->queries[] = Database::instance()->last_query;
            return $records;
        } else {
            if (count(Kohana::$config->load('settings.frontendLangs')) == 1 or current(Kohana::$config->load('settings.frontendLangs')) == $lang or !count($this->_translate_fields)) {
                $records = parent::find_all()->as_array();
                $this->queries[] = Database::instance()->last_query;
                return $records;
            }

            $records = $this->findInViewTable($lang);

            return $records;
        }
    }

    public function findByPk($id, $lang = false)
    {
        return $this->where($this->_primary_key,'=',$id)->find($lang);
    }

    public function findByParams(array $filters,$lang = null)
    {
        foreach ($filters as $index=>$item) {
            $this->where($index,(is_array($item)) ? 'IN' : '=',$item);
        }

        return $this->find($lang);
    }

    public function findAllByParams(array $filters,$lang = null)
    {
        foreach ($filters as $index=>$item) {
            $this->where($index,(is_array($item)) ? 'IN' : '=',$item);
        }

        return $this->find_all($lang);
    }

    public function getAllAsArray()
    {
        $result = array();
        $query = ($this->_soft_delete_field) ? $this->withoutSoftDeleteItems()->as_array() : $this->find_all(I18n::$lang);

        foreach ($query as $item) {
            $result[] = $item->as_array();
        }

        return $result;
    }

    public function getRandom($limit = null)
    {
        $query = $this->setEnabled()->order_by(DB::expr('RAND()'));
        if ($limit) $query->limit($limit);

        return $query->find_all(I18n::$lang);
    }
    
    public function setRandom($limit = null)
    {
        $query = $this->order_by(DB::expr('RAND()'));
        if ($limit) $query->limit($limit);

        return $query;
    }

    public function getForSelect($q,$ids)
    {
        $nameFields = $this->getNamesFields();

        if (empty($q) or mb_strlen($q) <= 3) return array();

        $query = DB::select(
                array($this->primary_key(),'value'),
                array(DB::expr('CONCAT_WS(" ",'.join(',',$nameFields).')'),'name')
            )
            ->from($this->table_name())
            ->where(DB::expr('CONCAT_WS(" ",'.join(',',$nameFields).')'),'LIKE','%'.$q.'%');

        if (!empty($ids)) $query->where($this->primary_key(),'NOT IN',$ids);

        $query =  $query->execute()->as_array();

        return $query;
    }

    public function getForPage($page,$limit,$where = array(),$records_is_array = false)
    {
        if (!empty($where))
        {
            foreach($where as $item)
            {
                $this->where($item['column'],$item['rel'],$item['value']);
            }
        }

        $records = clone $this;
        $sum = $this->count_all();

        $max = ceil($sum/$limit);

        $records = $records
            ->offset(($page-1)*$limit)
            ->limit($limit)
            ->find_all(I18n::$lang);
        
        $result = array(
            'page'=>$page,
            'limit'=>$limit,
            'max'=>$max,
            'recordsNum'=>$sum,
            'records'=>$records
        );
        
        if ($records_is_array) {
            $temp = array();
            foreach ($result['records'] as $item) {
                $temp[] = $item->getForJson();
            }

            $result['records'] = $temp;
        }
            
            
        return $result;
    }
	
	public function getEmptyPager($page,$limit)
    {
        return array(
            'page'=>$page,
            'limit'=>$limit,
            'max'=>0,
            'recordsNum'=>0,
            'records'=>array()
        );
    }

    public function getAll()
    {
       return $this->setEnabled()->setAllOrder()->find_all(I18n::$lang);
    }
    
}