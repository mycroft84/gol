<?php
/**
 * User: Tibor
 * Date: 2015.10.17.
 * Time: 17:45
 * Project: enigma
 * Company: d2c
 */
class Kohana_Restful_Output_Json implements Kohana_Restful_Output_Interface
{
    protected $context;
    /*
     * var Response
     */
    protected $response;
    protected $statusCode;

    public static function factory($context,Response $response,$statusCode)
    {
        $json = new Restful_Output_Json();
        $json->context = (!isset($context->jsonCallback)) ? json_encode((is_object($context)) ? (array) $context : $context, JSON_UNESCAPED_SLASHES) : $context->jsonCallback."(".json_encode((array) $context).");";
        $json->response = $response;
        $json->statusCode = $statusCode;

        return $json;
    }

    public function render()
    {
        $this->response->body($this->context);
    }

    public function setHeader()
    {
        $this->response->status($this->statusCode);
        $this->response->headers('content-type', 'application/json; charset=utf-8');
        $this->response->headers('content-length', (string) strlen($this->context));
        $this->response->headers("Access-Control-Allow-Origin", "*");
        $this->response->headers("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE, OPTIONS");
        $this->response->headers("Access-Control-Allow-Headers", "Content-Type, Accept, Authorization");
    }
}