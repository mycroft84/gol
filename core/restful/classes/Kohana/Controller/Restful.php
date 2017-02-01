<?php
/**
 * User: Tibor
 * Date: 2015.10.17.
 * Time: 10:22
 * Project: enigma
 * Company: d2c
 */
class Kohana_Controller_Restful extends Controller
{
    protected $benchmark = null;

    protected $_params;

    protected $_auth_type = Restful_Auth::AUTH_TYPE_HASH;
    protected $_auth_source = Restful_Auth::AUTH_SOURCE_HEADER;
    protected $_auth_user_type = Restful_Auth::AUTH_USER_TYPE_TOKEN;

    /**
     * @var Restful_Auth
     */
    protected $auth = null;
    protected $logged_in = false;

    /*
     * json, xml
     */
    protected $output_format;
    protected $template;
    protected $context;
    protected $headers;
    protected $emptyResponse = false;

    protected $httpStatusCode = 200;

    public function before()
    {
        $this->_overwrite_method();
        $this->_init_params();

        if ($this->_auth_type != Restful_Auth::AUTH_TYPE_OFF) {
            $this->auth = new Restful_Auth($this->_auth_type,$this->_auth_user_type,$this->_params);
            $this->logged_in = true;
        }

        $this->output_format = $this->request->param('format','json');
        $this->context = new stdClass();
        $this->headers = new stdClass();
    }

    public function after()
    {
        if (in_array($this->request->method(), array
        (
            HTTP_Request::PUT,
            HTTP_Request::POST,
            HTTP_Request::DELETE
        )))
        {
            $this->response->headers('cache-control', 'no-cache, no-store, max-age=0, must-revalidate');
        }

        //echo Debug::vars($this->output_format,$this->template,$this->context,$this->response);exit;

        if ($this->benchmark)
        {
            // Stop the benchmark
            Profiler::stop($this->benchmark);
            $profiler = View::factory('profiler/stats')->render();
            $file = $this->request->controller().DIRECTORY_SEPARATOR.$this->request->action().".html";
            Profiler::save($file,$profiler);
        }

        $this->response->headers((array) $this->headers);
        
        if (!$this->emptyResponse)
            Restful_Output::factory($this->output_format,$this->template,$this->context,$this->response,$this->httpStatusCode)->render();
    }

    protected function _overwrite_method()
    {
        if (HTTP_Request::GET == $this->request->method() && ($method = $this->request->query('method')))
        {
            switch (strtoupper($method))
            {
                case HTTP_Request::POST:
                case HTTP_Request::PUT:
                case HTTP_Request::DELETE:
                    $this->request->method($method);
                    break;

                default:
                    break;
            }
        }
        else
        {
            // Try fetching method from HTTP_X_HTTP_METHOD_OVERRIDE before falling back on the detected method.
            $this->request->method( Arr::get($_SERVER, 'HTTP_X_HTTP_METHOD_OVERRIDE', $this->request->method()) );
        }
    }

    protected function _init_params()
    {
        $params = array();

        switch ($this->request->method())
        {
            case HTTP_Request::POST:
            case HTTP_Request::PUT:
            case HTTP_Request::DELETE:
                if (isset($_SERVER['CONTENT_TYPE']) && false !== strpos($_SERVER['CONTENT_TYPE'], 'application/json'))
                {
                    $parsed_body = json_decode($this->request->body(), true);
                }
                elseif (isset($_SERVER['CONTENT_TYPE']) && false !== strpos($_SERVER['CONTENT_TYPE'], 'xml'))
                {
                    $parsed_body = $this->getXmlParams($this->request->body());
                }
                else
                {
                    parse_str($this->request->body(), $parsed_body);
                }
                $params = array_merge((array) $parsed_body, (array) $this->request->post());

                // No break because all methods should support query parameters by default.
            case HTTP_Request::GET:
                $params = array_merge((array) $this->request->query(),(array) $this->request->param(), $params);
                break;

            default:
                break;
        }

        if ($this->_auth_source == Restful_Auth::AUTH_SOURCE_HEADER) {
            $params = array_merge($params,(array) $this->request->headers());
        }

        $this->_params = $params;
    }

    protected function getXmlParams($body)
    {
        $xml = simplexml_load_string($body);
        $json = json_encode($xml);
        $array = json_decode($json,TRUE);

        return $array;
    }
    
    protected function addErrors(Exception $e)
    {
        $this->context->code = ($e->getCode()) ? $e->getCode() : 500;
        $this->httpStatusCode = ($this->context->code == 404) ? 404 : 500;
        if ($e instanceof ORM_Validation_Exception) {
            $this->context->message = $e->errors();
        } else {
            $this->context->message = $e->getMessage();
        }
    }

    protected function setEmptyResponse()
    {
        $this->emptyResponse = true;
    }
}