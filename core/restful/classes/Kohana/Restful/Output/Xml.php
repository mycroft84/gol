<?php
/**
 * User: Tibor
 * Date: 2015.10.17.
 * Time: 17:45
 * Project: enigma
 * Company: d2c
 */
class Kohana_Restful_Output_Xml implements Kohana_Restful_Output_Interface
{
    protected $context;
    protected $response;
    protected $template;
    protected $statusCode;

    protected $xml;

    public static function factory($context,$template,Response $response,$statuscode)
    {
        $xml = new Restful_Output_Xml();
        $xml->context = $context;
        $xml->response = $response;
        $xml->template = $template;
        $xml->statusCode = $statuscode;

        return $xml;
    }

    public function render()
    {
        $this->setContext();

        $this->response->headers('content-length', (string) strlen($this->xml));
        $this->response->body($this->xml);
    }

    public function setHeader()
    {
        $this->response->status($this->statusCode);
        $this->response->headers('content-type', 'application/xml');
    }

    protected function setContext()
    {
        $this->xml = Twig::get_template_content(
            $this->template,
            (array) $this->context
        );
    }
}