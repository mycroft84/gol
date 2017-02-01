<?php
/**
 * User: MyCroft
 * Date: 15-01-07
 * Time: 13:32
 * Company: d2c
 */
class Grid_Details_Files extends Grid_Details
{
    protected $tableName = "files";
    protected $onDetails = true;

    protected function getDisabledFields() {
        return array(
            'fi_table',
            'fi_ref_id',
            'fi_input_name',
            'fi_user',
            'fi_order',
        );
    }

    protected function getDefaults() {
        return array(
            'order'=>'fi_id',
            'orderDir'=>'asc',
            'limit'=>10
        );
    }

    protected function enabledEdit()
    {
       return false;
    }

    protected function getActionButtons($item)
    {
        $buttons = parent::getActionButtons($item);

        $buttons['edit'] = array(
            'title'=>'Letöltés',
            'button'=>'success',
            'icon'=>'fa-download',
            'url'=>Route::url('fileDownload',array('id'=>$item->pk())),
            'hasLayer'=>false
        );

        return $buttons;
    }
}