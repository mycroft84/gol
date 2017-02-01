<?php
/**
 * User: Tibor
 * Date: 2015.10.17.
 * Time: 14:31
 * Project: enigma
 * Company: d2c
 */
abstract class Kohana_Restful_Auth
{
    /**
     * Request authentication types.
     */
    const AUTH_TYPE_OFF		= 'off';

    /**
     * all time have apikey and secret, teh secret dont send
     */

    /**
     * Induvidual users has apikey, every user have api and secret, api and hash send
     */
    const AUTH_TYPE_APIKEY	= 'apikey';

    /**
     * Common public key and secret, only request validate, like app request
     */
    const AUTH_TYPE_HASH	= 'hash';

    /**
     * Request authentication source.
     */
    const AUTH_SOURCE_GET		= 1; // The user passes the authentication data as GET parameters.
    const AUTH_SOURCE_HEADER	= 2; // The user passes the authentication data as HTTP headers.

    const AUTH_USER_TYPE_OFF = 0;
    const AUTH_USER_TYPE_API = 1;
    const AUTH_USER_TYPE_TOKEN = 2;

    /**
     * Request parameter names for request validate
     */
    protected $keyName = 'x-key';
    protected $hashName	= 'x-hash';
    protected $nonceName = 'x-nonce';
    protected $createdName = 'x-created';

    /**
     * Request parameter names for user
     */
    protected $tokenName = 'x-token';

    protected $secret = null;
    protected $apikey = null;

    protected $params = array();
    protected $authType;
    protected $authUserType;

    protected $user = null;
    protected $token = null;

    function __construct($auth_type,$auth_user,array $params)
    {
        $this->params = $params;
        $this->authType = $auth_type;
        $this->authUserType = $auth_user;

        $this->_init();
        $this->validate();
        $this->checkUser();
    }

    protected function _init()
    {
        if ($this->authType == self::AUTH_TYPE_HASH) {
            $config = Kohana::$config->load('restful');

            $this->secret = $config->commonSecret;
            $this->apikey = $config->commonApikey;
        } else {
            $this->apikey = $this->params[$this->keyName];
            $this->secret = $this->getAuthSecret($this->apikey);
            if (!$this->secret) {
                Restful_Exception::_401_exception('Invalid '. $this->apikey .' value');
            }
        }
    }

    /*
     * if has secret key set authenticated user
     */
    abstract protected function getAuthSecret($apiKey);
    abstract protected function getUserByToken($token);

    public function checkUser()
    {
        if ($this->authUserType == self::AUTH_USER_TYPE_TOKEN)  {
            $this->getUserByToken($this->params[$this->tokenName]);
            if (!$this->user) {
                Restful_Exception::_401_exception('Invalid user');
            }
        }
    }

    /**
     * @return Model_Frontendusers
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return Model_Fuser_Token
     */
    public function getToken()
    {
        return $this->token;
    }

    protected function validate()
    {
        $myHash = $this->createHash($this->params[$this->nonceName],$this->params[$this->createdName]);

        if ($myHash != $this->params[$this->hashName]) {
            Restful_Exception::_401_exception('Invalid '. $this->hashName .' value');
        }
    }

    protected function createHash($nonce, $created)
    {
        return base64_encode(sha1($nonce . $created . base64_encode(md5($this->apikey) . $this->secret)));
    }
}