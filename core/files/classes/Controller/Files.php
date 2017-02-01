<?php

class Controller_Files extends Controller_DefaultTemplate
{
    function before()
    {
        if (Session::instance()->get('ad_default_lang'))
		{
		   $lang = Session::instance()->get('ad_default_lang');	
		}
		else if (Cookie::get('default_lang',false))
		{
			$lang = Cookie::get('default_lang');
		}
		else $lang='hu';
		I18n::lang($lang);
    }
    
    function action_index()
    {
        $this->context->title = 'Fájlok listázása';
        $this->context->columns = ORM::factory('Files')->list_columns();
        $this->context->files = ORM::factory('Files')->where('fi_table','=',$this->request->param('table'))->where('fi_ref_id','=',$this->request->param('id'))->find_all();
    }
    
    function action_ajax()
    {
        $model = new Model_Files();
        $this->auto_render = false;
        switch($this->request->param('actiontarget'))
        {
            case 'addFiles':
                $data = $model->saveAll(Input::post_all());
                echo json_encode($data);
                break;
            
            case 'del':
                $data = $model->del(Input::post('id'));
                echo json_encode($data);
                break;

            case 'setFileType':
                $data = $model->setFileType(Input::post('id'),Input::post('types'));
                echo json_encode($data);
                break;

            case 'setOrder':
                $data = $model->setOrder(Input::post('ids'));
                echo json_encode($data);
                break;

            case 'setInput':
                $data = $model->setInput(Input::post('id'),Input::post('name'),Input::post('val'));
                echo json_encode($data);
                break;

            case 'files':
                switch($this->request->param('maintarget'))
                {
                    case 'getGridDetails':
                        $model = new Model_Files();
                        $grid = Grid::factory('Details_Files',$model);
                        $grid->setDefaultFilters(json_decode(Input::post('setDefaultFilters'),true));
                        echo json_encode($grid->getData(Input::post('page'),Input::post('order'),Input::post('orderDir'),Input::post('limit'),Input::post('filter')));
                        break;
                }
                break;
            
            default: echo json_encode("Action target not found!");
        }
    }
    
}