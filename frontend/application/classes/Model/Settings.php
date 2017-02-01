<?php
/**
 * User: MyCroft
 * Company: design2code.hu
 * Product: d2cadmin
 * Date: 2013.05.11.
 * Time: 11:05
 */
class Model_Settings extends ORM {

    protected $_table_name = 'settings';
    protected $_primary_key = 'set_id';

    public function getGrid($data)
    {
        $records = DB::select(
                's.set_id',
                array('l.text','set_name'),
                's.set_value'
            )
            ->from(array('settings','s'))
            ->join(array('languages','l'),'left')
                ->on('s.set_name','=','l.target')
            ->where('s.set_display','=',1)
            ->where('l.lang','=',I18n::$lang)
            ->where('l.modul','=','settingsName')
        ;

        switch($data['sidx'])
        {
            case 'set_name': $data['sidx'] = 'l.text'; break;

            default: $data['sidx'] = 's.'.$data['sidx'];
        }

        if (isset($data['filter']) and $data['filter'] != '[]')
        {
            $filter = Model_Filters::convertFilters($data['filter']);
            foreach($filter as $item)
            {
                switch($item['name'])
                {
                    case 'set_name': $records->where('l.text',$item['rel'],$item['value']); break;

                    default: $records->where('s.'.$item['name'],$item['rel'],$item['value']); break;
                }
            }
        }

        return Model_Grid::formatObject($records,$data);
    }

    public function autocomplete($data)
    {
        switch ($data['category'])
        {
            case 'set_name':  $select = DB::select(array('l.text','name')); $where = 'l.text'; break;

            default: $select = DB::select(array('s.'.$data['category'],'name')); $where = 's.'.$data['category']; break;
        }


        return $select->distinct(true)->from(array('settings','s'))
            ->from(array('settings','s'))
            ->join(array('languages','l'),'left')
                ->on('s.set_name','=','l.target')
            ->where('s.set_display','=',1)
            ->where('l.lang','=',I18n::$lang)
            ->where('l.modul','=','settingsName')
            ->where($where,'LIKE','%'.$data['term'].'%')
            ->execute()->as_array();
    }

    public function change($data)
    {
        try {
            $row = $this->where('set_id','=',$data['id'])->find();
            $row->set_value = $data['value'];
            $row->save();

            return array('error'=>false);
        } catch (Exception $e) {
            return array('error'=>true,'message'=>$e->getMessage());
        }
    }


}