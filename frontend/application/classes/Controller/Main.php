<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Main extends Controller_DefaultTemplate
{

    function action_index()
	{
        $this->context->current_menu = 'main';
        $this->context->title = 'Főoldal';

        $this->context->width = Input::get('width');
        $this->context->height = Input::get('height');

        $lives = explode("\n",Input::get('lives'));
        $this->context->lives = $lives;

        $this->context->boards = ORM::factory('Board')->getAll();
	}

    public function action_ajax()
    {
        switch ($this->request->param('actiontarget'))
        {
            case 'gol':
                switch($this->request->param('maintarget'))
                {
                    case 'getNextStep':
                        try {
                            $data = Model::factory('Api')->getNextState(Input::post('board'),Input::post('alives'));
                            echo json_encode(array('error'=>false,'alives'=>$data));
                        } catch (Exception $e) {
                            echo json_encode(array('error'=>true,'message'=>$e->getMessage()));
                        }
                        break;

                    case 'save':
                        $data = ORM::factory('Board')->addBoard(Input::post_all());
                        echo json_encode($data);
                        break;

                    case 'load':
                        $data = ORM::factory('Board')->loadBoard(Input::post('id'));
                        echo json_encode($data);
                        break;
                }
                break;

            default: echo json_encode('Action target not found');
        }
    }

}