<?php
/**
 * User: Tibor
 * Date: 2013.09.05.
 * Time: 20:32
 * Project: d2cadmin3.3
 * Company: d2c
 */
class HTTP_Exception extends Kohana_HTTP_Exception {

    /**
     * Generate a Response for the 401 Exception.
     *
     * The user should be redirect to a login page.
     *
     * @return Response
     */
    public function get_response()
    {
        // Lets log the Exception, Just in case it's important!
        //Logging_Channels_System::instance()->addError($this->getMessage(),array('type'=>'HTTP','code'=>$this->getCode()));

        if (Kohana::$environment >= Kohana::DEVELOPMENT)
        {
            // Show the normal Kohana error page.
            return parent::get_response();
        }
        else
        {
            $attributes = array
            (
                'action'  => $this->getCode(),
                'message' => rawurlencode($this->getMessage())
            );

            $html = Request::factory(Route::get('error')->uri($attributes))
                ->execute()
                ->send_headers()
                ->body();

            $response = Response::factory()
                ->status($this->getCode())
                ->body($html);

            return $response;

        }
    }

}