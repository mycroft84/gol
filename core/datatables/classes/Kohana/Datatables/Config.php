<?php
/**
 * User: Tibor
 * Date: 2014.03.21.
 * Time: 13:02
 * Project: d2cadmin3.3
 * Company: d2c
 */
class Kohana_Datatables_Config
{
    public $target;
    public $getDataUrl;
    public $renderMode;
    public $cols = array();
    public $pageLimit = array();

    public static function factory()
    {
        $config = new Datatables_Config();
        return $config;
    }

    public function getConfig()
    {
        $result = array(
            'target'=>$this->target,
            'renderMode'=>$this->renderMode,
            'config'=>array(
                "bFilter"=>false,
                "aLengthMenu"=>array(array_values($this->pageLimit),array_keys($this->pageLimit)),
                "oLanguage"=>$this->languages(),
                "bStateSave"=>true
            )
        );

        if ($this->renderMode == Datatables::AJAX)
        {
            $result['config'] = array_merge($result['config'],$this->getAjaxConfig());
        }

        return $result;
    }

    public function formatDataForAjaxSource($records,$total)
    {
        $result = array(
            'sEcho'=>time(),
            'iTotalRecords'=>(int) $total,
            'iTotalDisplayRecords'=>(int) $total, //filtered row
            'aaData'=>$records
        );

        return $result;
    }

    private function languages(){
        return array(
            "oPaginate"=>array(
                "sFirst"=>__("oPaginate.sFirst"),
                "sLast"=>__("oPaginate.sLast"),
                "sNext"=>__("oPaginate.sNext"),
                "sPrevious"=>__("oPaginate.sPrevious"),
            ),
            "sEmptyTable"=>__("sEmptyTable"),
            "sInfo"=>__("sInfo"),
            "sInfoEmpty"=>__("sInfoEmpty"),
            "sInfoFiltered"=>__("sInfoFiltered"),
            "sLengthMenu"=>__("sLengthMenu"),
            "sLoadingRecords"=>__("sLoadingRecords"),
            "sProcessing"=>__("sProcessing"),
            "sSearch"=>__("sSearch"),
            "sZeroRecords"=>__("sZeroRecords"),
        );
    }

    private function getAjaxConfig()
    {
        return array(
            "bProcessing"=>true,
            "bServerSide"=>true,
            "sAjaxSource"=>$this->getDataUrl,
            "sServerMethod"=>"POST",
            "aoColumns"=>$this->formatColsIndex(),
        );
    }

    private function formatColsIndex()
    {
        $result = array();
        foreach($this->cols as $item)
        {
            $result[] = array(
                "mData"=>$item
            );
        }

        return $result;
    }

}