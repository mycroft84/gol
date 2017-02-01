<?php

class Controller_Download extends Controller
{
    function action_index()
    {
        echo "Access Denied!";
    }
    
    function action_files()
    {
        Model_Download::download(array('fi_id'=>$this->request->param('id')));
    }

    function action_preview()
    {
        $path = Model_Download::preview(array('fi_id'=>$this->request->param('id')));

        $this->response->headers('Content-Type', File::mime($path));
        $this->response->body(file_get_contents($path));
    }
}