<?php
/**
 * User: MyCroft
 * Date: 2013.09.05.
 * Time: 10:59
 * Project: d2cadmin3.3
 * Company: d2c
 *
 * KO Logging with Monolog
 */
class Kohana_Logging
{
    /*
     * stream - \Monolog\Handler\StreamHandler
     * firebug \Monolog\Handler\FirePHPHandler
     */
    public $handlers = array('stream');
    protected $cHandler = array();
    public $channelName = 'log';

    public $additionalFields = array();

    public $level_dirs = array(
        'debug'=>'debug',
        'info'=>'info',
        'notice'=>'notice',
        'warning'=>'warning',
        'error'=>'error',
        'critical'=>'critical',
        'alert'=>'alert',
        'emergency'=>'emergency'
    );

    protected $email_from = null;

    private $ROOT = 'monolog';

    public function addDebug($message, array $context = array(), array $handlers = array())
    {
        $this->cHandler = $handlers;
        $this->addMessage($message,$context,'DEBUG');
    }

    public function addInfo($message,array $context = array(), array $handlers = array())
    {
        $this->cHandler = $handlers;
        $this->addMessage($message,$context,'INFO');
    }

    public function addNotice($message, array $context = array(), array $handlers = array())
    {
        $this->cHandler = $handlers;
        $this->addMessage($message,$context,'NOTICE');
    }

    public function addWarning($message, array $context = array(), array $handlers = array())
    {
        $this->cHandler = $handlers;
        $this->addMessage($message,$context,'WARNING');
    }

    public function addError($message, array $context = array(), array $handlers = array())
    {
        $this->cHandler = $handlers;
        $this->addMessage($message,$context,'ERROR');
    }

    public function addCritical($message, array $context = array(), array $handlers = array())
    {
        $this->cHandler = $handlers;
        $this->addMessage($message,$context,'CRITICAL');
    }

    public function addAlert($message, array $context = array(), array $handlers = array())
    {
        $this->cHandler = $handlers;
        $this->addMessage($message,$context,'ALERT');
    }

    public function addEmergency($message, array $context = array(), array $handlers = array())
    {
        $this->cHandler = $handlers;
        $this->addMessage($message,$context,'EMERGENCY');
    }

    private function addMessage($message, $context, $type)
    {
        $logger = new \Monolog\Logger($this->channelName);
        $this->addHandler($logger,$type,$context);

        $method = 'add'.ucfirst(strtolower($type));
        $logger->$method($message,$context);
    }

    private function addHandler(\Monolog\Logger &$logger,$level,$context)
    {
        $cHandler = (!empty($this->cHandler)) ? $this->cHandler : $this->handlers;

        foreach($cHandler as $item)
        {
            switch($item)
            {
                case 'stream':
                    $dir = APPPATH."logs".DIRECTORY_SEPARATOR.$this->ROOT.DIRECTORY_SEPARATOR.$this->channelName.DIRECTORY_SEPARATOR.$this->level_dirs[strtolower($level)];
                    $filename = date('Y-m-d').".log";
                    $this->checkDirs($dir);
                    $logger->pushHandler(new \Monolog\Handler\StreamHandler($dir.DIRECTORY_SEPARATOR.$filename, constant('\Monolog\Logger::'.$level)));
                    break;

                case 'mysql':
                    $pdo = new PDO('mysql:host='.Kohana::$config->load('baseconfig.host').';dbname='.Kohana::$config->load('baseconfig.database'), Kohana::$config->load('baseconfig.username'), Kohana::$config->load('baseconfig.password'));
                    $logger->pushHandler(new \Monolog\Handler\MySQLHandler($pdo, $this->channelName, $this->additionalFields, constant('\Monolog\Logger::'.$level)));
                    break;

                case 'firebug':
                    $logger->pushHandler(new \Monolog\Handler\FirePHPHandler());
                    break;

                case 'email':
                    $transport = Swift_MailTransport::newInstance();
                    $mailer = Swift_Mailer::newInstance($transport);

                    $message = Swift_Message::newInstance($this->getMailSubject(constant('\Monolog\Logger::'.$level)))
                          ->setFrom($this->email_from)
                          ->setTo($this->getMailTo(constant('\Monolog\Logger::'.$level))) //kinek
                          ->setBody($this->getMailBody($context,constant('\Monolog\Logger::'.$level)),'text/html')
                          ->addPart(strip_tags($this->getMailBody($context,constant('\Monolog\Logger::'.$level))),'text/plain');

                    $logger->pushHandler(new \Monolog\Handler\OwnSwiftMailerHandler($mailer,$message,constant('\Monolog\Logger::'.$level)));
                    break;
            }
        }
    }

    private function checkDirs($dir)
    {
        $root = APPPATH."logs".DIRECTORY_SEPARATOR;

        $temp = str_replace($root,'',$dir);
        $parts = explode(DIRECTORY_SEPARATOR,$temp);
        if (!is_dir($root.$parts[0])) mkdir($root.$parts[0],0777);
        if (!is_dir($root.$parts[0].DIRECTORY_SEPARATOR.$parts[1])) mkdir($root.$parts[0].DIRECTORY_SEPARATOR.$parts[1],0777);
        if (!is_dir($dir)) mkdir($dir,0777);
    }

    protected function getMailBody($context,$level)
    {
        return "";
    }

    protected function getMailSubject($level)
    {
        return "";
    }

    protected function getMailTo($level)
    {
        return array();
    }
}