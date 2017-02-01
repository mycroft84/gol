<?php
/**
 * User: MyCroft
 * Date: 2013.07.04.
 * Time: 15:12
 * Company: d2c
 *
 * TODO: search, compose
 */
class Kohana_Imap
{
    protected $server;
    protected $username;
    protected $password;

    protected $currentForder;
    protected $connection = false;


    public static function factory($server = 'gmail')
    {
        $imap = new Imap();

        switch($server)
        {
            case 'gmail':
                $imap->server = '{imap.gmail.com:993/imap/ssl}';
                break;

            default: $imap->server = $server;
        }

        return $imap;
    }

    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function setFolder(Imap_Folder $folder)
    {
        $this->currentForder = $folder->getFolder();
        return $this;
    }

    public function connect()
    {
        if (!$this->connection)
            $this->connection = imap_open($this->server.mb_convert_encoding($this->currentForder,"UTF7-IMAP","UTF-8"),$this->username,$this->password) or die('Cannot connect to Gmail: ' . imap_last_error());

        return $this;
    }

    public function reconnect()
    {
        $this->disconnect();
        $this->connect();

        return $this;
    }

    public function disconnect()
    {
        imap_close($this->connection,CL_EXPUNGE);
        $this->connection = false;
    }

    public function checkConnection()
    {
        return imap_check($this->connection);
    }

    /**
     * @return mixed
     */
    public function getServer()
    {
        return $this->server;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getCurrentForder()
    {
        return $this->currentForder;
    }

    /**
     * @return boolean
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @return int
     */
    public function getRevers()
    {
        return $this->revers;
    }


}