<?php

class Controller_Jshelper extends Controller_Twig
{
    function before()
    {
        parent::before();

        $requestLang = ORM::factory('languages')->getRequestLang($this->request);
        I18n::lang($requestLang['lang']);

        $this->response->headers('Content-Type', 'application/javascript');
        $this->response->headers('cache-control','public, max-age=3600');

    }

    function action_routing()
    {
        $this->context->routings = Model_Jshelper::getRouting();
    }

    function action_settings()
    {
        $this->context->settings = ORM::factory('Settings')->where('set_add_js','=',1)->find_all();
    }

    function action_i18n()
    {
        I18n::lang($this->request->param('slug'));
        $this->context->langs = I18n::load($this->request->param('slug'));
    }

    function action_helper()
    {
        $data = array('helper'=>__(Input::post('helper')));
        echo json_encode($data);
    }
}