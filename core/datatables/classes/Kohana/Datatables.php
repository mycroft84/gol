<?php
/**
 * User: Tibor
 * Date: 2014.03.20.
 * Time: 20:15
 * Project: d2cadmin3.3
 * Company: d2c
 */
class Kohana_Datatables
{
    protected $orm;
    protected $pageLimit = array(
        10=>10,
        25=>25,
        50=>50,
        100=>100
    );

    protected $renderMode = "dom";
    const DOM = "dom";
    const AJAX = "ajax";

    protected function getDataUrl() { return ""; }
    protected function joinNameField() { return array(); }
    protected function dateFieldFormat() { return array(); }

    private $_columns = array();
    private $target = "";

    public static function factory($name,$orm)
    {
        $className = self::getClassName($name);
        $datables = new $className($orm);

        return $datables;
    }

    public function __construct(ORM $orm)
    {
        $this->orm = $orm;
        $this->_columns = array_keys($orm->list_columns());
        $this->target = $this->orm->table_name();
    }

    private function getClassName($name)
    {
        $parts = explode('_',$name);
        $result = array('Datatables');
        foreach($parts as $item)
        {
            $result[] = ucfirst($item);
        }

        return join('_',$result);
    }

    public function getInit()
    {
        $config = Datatables_Config::factory();
        $config->target = $this->target;
        $config->renderMode = $this->renderMode;
        $config->getDataUrl = $this->getDataUrl();
        $config->cols = $this->_columns;
        $config->pageLimit = $this->pageLimit;

        return $config->getConfig();

    }

    public function render()
    {
        $view = Datatables_View::factory();
        $view->renderMode = $this->renderMode;
        $view->columns = $this->_columns;
        $view->target = $this->target;

        if ($this->renderMode == Datatables::DOM)
        {
            $view->records = $this->getRecords();
        }

        return $view;
    }

    public function getData($post)
    {
        $records = $this->getRecords($post['iDisplayLength'],$post['iDisplayStart'],$this->getOrders($post),$total);

        return Datatables_Config::factory()->formatDataForAjaxSource($records,$total);
    }

    private function getOrders($post)
    {
        $result = array();
        for($i=0;$i<$post['iSortingCols'];$i++)
        {
            $result[] = array(
                'column'=>$this->_columns[$post['iSortCol_'.$i]],
                'dir'=>$post['sSortDir_'.$i]
            );
        }

        return $result;
    }

    private function getRecords($limit = false,$offest = 1,$order_column = array(),&$total = 0)
    {
        $data = $this->orm;
        $total = $this->orm->count_all();

        if ($limit) {
            $data->limit($limit)->offset($offest);
        }

        if (!empty($order_column)) {
            foreach($order_column as $order)
            {
                $data->order_by($order['column'],$order['dir']);
            }
        }

        $data = $data->find_all();

        $data = Model_Jshelper::json_encode($data);
        $this->convertFields($data);

        return $data;
    }

    private function convertFields(&$data)
    {
        $joinFields = $this->getJoinFields();
        $dateFields = $this->getDateFields();
        $boolFields = $this->getBoolFields();

        foreach($data as &$item)
        {
            foreach($item as $index=>$value)
            {
                if (array_key_exists($index,$joinFields)) {
                    $item[$index] = $joinFields[$index][$value];
                }

                if (array_key_exists($index,$dateFields)) {
                    $item[$index] = date($dateFields[$index],$value);
                }

                if (in_array($index,$boolFields)) {
                    $item[$index] = ($value == 1) ? Kohana::subtitles('yes') : Kohana::subtitles('no');
                }
            }

            unset($item['files']);
            $item['DT_RowId'] = $item[$this->orm->primary_key()];
        }

    }

    private function getJoinFields()
    {
        $result = array();
        foreach($this->orm->belongs_to() as $name=>$belongs_to)
        {
            $result[$belongs_to['foreign_key']] = $this->getJoinValues($belongs_to);
        }

        return $result;
    }

    private function getJoinValues($belongs_to)
    {
        $nameFields = $this->getJoinNamesFields($belongs_to);
        $belongs_orm = ORM::factory($belongs_to['model']);

        $orm_values = DB::select(
                array($belongs_orm->primary_key(),'id'),
                array(DB::expr("CONCAT_WS(' ',".join(',',$nameFields).")"),'name')
            )->from($belongs_orm->table_name())
            ->execute()->as_array();

        $values = array();
        foreach($orm_values as $item)
        {
            $values[$item['id']] = $item['name'];
        }

        return $values;
    }

    private function getJoinNamesFields($belongs_to)
    {
        $joinNames = $this->joinNameField();
        $belongs_orm = ORM::factory($belongs_to['model']);
        $names = Database::instance()->list_columns($belongs_orm->table_name(),'%name%');


        return (array_key_exists($belongs_to['foreign_key'],$joinNames)) ? $joinNames[$belongs_to['foreign_key']] : array_keys($names);
    }

    private function getDateFields()
    {
        $columns = $this->orm->list_columns();
        $formats = $this->dateFieldFormat();

        $dates = array();
        foreach($columns as $index=>$col)
        {
            if ($col['data_type'] == 'varchar' and $col['character_maximum_length'] == 25) {
                $dates[$index] = (array_key_exists($index,$formats)) ? $formats[$index] : 'Y-m-d';
            }
        }

        return $dates;
    }

    private function getBoolFields()
    {
        $columns = $this->orm->list_columns();

        $bools = array();
        foreach($columns as $index=>$col)
        {
            if ($col['data_type'] == 'tinyint' and $col['display'] == 1) {
                $bools[] = $index;
            }
        }

        return $bools;
    }
}