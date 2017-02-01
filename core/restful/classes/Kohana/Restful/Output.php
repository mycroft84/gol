<?php
/**
 * User: Tibor
 * Date: 2015.10.17.
 * Time: 17:36
 * Project: enigma
 * Company: d2c
 */
class Kohana_Restful_Output
{
    CONST JSON = 1;
    CONST XML = 2;

    protected $type;
    protected $template;
    protected $context;
    protected $response;
    protected $statusCode;

    public static function factory($type,$template,$context,Response $response,$statusCode)
    {
        $output = new Restful_Output();

        $output->type = $type;
        $output->template = $template;
        $output->context = $context;
        $output->response = $response;
        $output->statusCode = (isset($context->HttpStatusCode) && !empty($context->HttpStatusCode)) ? $context->HttpStatusCode: $statusCode;

        return $output;
    }

    public function render()
    {
        switch($this->type)
        {
            case self::XML:
                $strategy = Restful_Output_Xml::factory($this->context,$this->template,$this->response,$this->statusCode);
                break;

            default:
                $strategy = Restful_Output_Json::factory($this->context,$this->response,$this->statusCode);
                break;
        }

        $strategy->setHeader();
        $strategy->render();
    }
}