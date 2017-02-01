<?php
/**
 * User: MyCroft
 * Date: 2013.09.05.
 * Time: 16:19
 * Project: d2cadmin3.3
 * Company: d2c
 */
class Logging_Channels_Trafficimport extends Kohana_Logging {

    public $channelName = 'log_traffic';
    public $handlers = array('stream','mysql','email');
    public $additionalFields = array('username','context','traf_id');

    public static function instance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new Logging_Channels_Trafficimport();
        }

        return $inst;
    }

    function __construct()
    {
        $this->email_from = array(Kohana::$config->load('logging.emailFromEmail') => Kohana::$config->load('logging.emailFromName'));
    }

    protected function getMailBody($context, $level)
    {
        $twig = Twig::get_template_content("Emailtemplate/logging/".$level.".twig",array("error"=>$context['context']));

        return $twig;
    }

    protected function getMailSubject($level)
    {
        return "Notification forgalmi adat feldolgozási hiba.";
    }

    protected function getMailTo($level)
    {

        return array(Kohana::$config->load("logging.trafficErrorEmailTo"));
    }


}