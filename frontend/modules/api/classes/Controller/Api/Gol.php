<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Api_Gol extends Controller_Restful
{
    public function before()
    {
        $this->_auth_user_type = Restful_Auth::AUTH_USER_TYPE_OFF;

        parent::before();
    }

    public function action_next()
    {
        try{
            $this->context->alives = Model::factory('Api')->getNextState($this->_params['board'],$this->_params['alives']);
        } catch (Exception $e) {
            $this->addErrors($e);
        }
    }

    public function action_getBoards()
    {
        try{
            $this->context = Model::factory('Board')->getBoards();
        } catch (Exception $e) {
            $this->addErrors($e);
        }
    }

    public function action_getLoadBoard()
    {
        try{
            $this->context = Model::factory('Board')->loadBoard($this->_params['board']);
        } catch (Exception $e) {
            $this->addErrors($e);
        }
    }
}