<?php
/**
 * User: MyCroft
 * Date: 2013.09.05.
 * Time: 16:19
 * Project: d2cadmin3.3
 * Company: d2c
 */
class Logging_Channels_User extends Kohana_Logging_Channels_User {

    public $channelName = 'log_user';
    public $handlers = array('stream','mysql');
    public $additionalFields = array('username','ip');

    function __construct()
    {
        $this->email_from = array(Kohana::$config->load('logging.emailFromEmail') => Kohana::$config->load('logging.emailFromName'));
    }

    protected function getMailBody($context, $level)
    {
        $twig = Twig::get_template_content("Emailtemplate/logging/".$level.".twig",array());

        return $twig;
    }

    protected function getMailSubject($level)
    {
        return "teszt";
    }

    protected function getMailTo($level)
    {
        return array("test@test.hu");
    }


}