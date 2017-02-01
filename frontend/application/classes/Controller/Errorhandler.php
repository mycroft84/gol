<?php
class Controller_Errorhandler extends Controller_DefaultTemplate
{
    public function before()
    {
        parent::before();
     
        $this->context->page = URL::site(rawurldecode(Request::$initial->uri()));
     
        //Internal request only!
        if (Request::$initial !== Request::$current)
        {
            if ($message = rawurldecode($this->request->param('message')))
            {
                $this->context->message = $message;
            }
        }
        else
        {
            $this->request->action(404);
        }
     
        $this->response->status((int) $this->request->action());
    }
    
    public function action_404()
    {
        $this->context->title = "HTTP 404";
    }
     
    public function action_500()
    {
        $this->context->title = "HTTP 500";
    }
}