<?php
/**
 * User: Tibi
 * Date: 2015.10.21.
 * Time: 12:32
 * Project: redmozi_web
 * Company: d2c
 */
class Kohana_Storages_Ftp extends Storages
{
    protected $host;
    protected $port;
    protected $username;
    protected $password;
    protected $ssl;

    protected $connection = null;
    protected $login = false;

    function __construct($name, $config)
    {
        $this->host = $config['login']['host'];
        $this->port = $config['login']['port'];
        $this->username = $config['login']['username'];
        $this->password = $config['login']['password'];
        $this->ssl = $config['ssl'];
        $this->baseUrl = $config['baseUrl'];
        $this->uploadDir = ($config['baseUploadDir']) ? $config['baseUploadDir'].'/'.$config['uploadDir'] : $config['uploadDir'];

        $this->oUploadDir = $config['uploadDir'];

        $this->login();
    }

    function __destruct() {
        $this->logout();
    }

    protected function connect()
    {
        $connection = ($this->ssl) ? ftp_ssl_connect($this->host,$this->port) : ftp_connect($this->host,$this->port);
        if (!$connection) {
            throw new Kohana_Exception('Storages connection to :host',array(
                ':name' => $this->host.":".$this->port
            ));
        }

        $this->connection = $connection;
    }

    protected function login()
    {
        if ($this->login) return true;
        if ($this->connection == null) $this->connect();

        if (@ftp_login($this->connection, $this->username, $this->password)) {

            $this->login = true;
            return $this->login;

        } else {
            throw new Kohana_Exception("Storages couldn't connect as :username",array(
                ':username' => $this->username
            ));
        }
    }

    protected function logout()
    {
        ftp_close($this->connection);
        $this->connection = null;
        $this->login = false;
    }

    public function upload(array $file, $filename = NULL, $directory = NULL, $chmod = 0644)
    {
        if ( ! isset($file['tmp_name']) OR ! is_uploaded_file($file['tmp_name']))
        {
            // Ignore corrupted uploads
            return FALSE;
        }

        if ($filename === NULL)
        {
            // Use the default filename, with a timestamp pre-pended
            $filename = uniqid().$file['name'];
        }

        if ($this->remove_spaces === TRUE)
        {
            // Remove spaces from the filename
            $filename = preg_replace('/\s+/u', '_', $filename);
        }

        if ($directory === NULL)
        {
            // Use the pre-configured upload directory
            $directory = $this->uploadDir;
        }

        if ( !$this->isDirectory($directory))
        {
            throw new Kohana_Exception('Directory :dir must be writable',
                array(':dir' => Debug::path($directory)));
        }

        // Make the filename into a complete path
        $filename = $directory.'/'.$filename;

        $put = ftp_put($this->connection,$filename,$file['tmp_name'],FTP_BINARY);

        return $put;
    }

    public function get($filename)
    {
        if (!$this->exists($filename)) return false;
        return $this->baseUrl.'/'.$this->oUploadDir.'/'.$filename;
    }

    public function getRealPath($filename)
    {
        if (!$this->exists($filename)) return 0;
        return $this->oUploadDir.'/'.$filename;
    }

    public function filesize($filename)
    {
        if (!$this->exists($filename)) return 0;

        $url = $this->getFileFTPUrl($filename);
        return filesize($url);
    }

    public function createFile($data,$filename)
    {
        $url = $this->getFileFTPUrl($filename);
        return file_put_contents($url,$data);
    }

    public function getFileContent($filename)
    {
        if (!$this->exists($filename)) return "";
        return file_get_contents($this->getFileFTPUrl($filename));
    }

    public function exists($filename)
    {
        $url = $this->getFileFTPUrl($filename);
        return is_file($url);
    }

    protected function getFileFTPUrl($filename)
    {
        $url = "ftp://".$this->username.":".$this->password."@".$this->host.":".$this->port."/".$this->uploadDir."/".$filename;
        return $url;
    }

    public function copy($source, $dest, $context = null)
    {
        if (!$this->exists($source)) return false;

        $sourceFile = $this->getFileFTPUrl($source);
        $destFile = $this->getFileFTPUrl($dest);

        if ($context) {
            return copy($sourceFile,$destFile,$context);
        }

        return copy($sourceFile,$destFile);
    }

    public function rename($source, $new_name, $context = null)
    {
        if (!$this->exists($source)) return false;
        $sourceFile = $this->getFileFTPUrl($source);
        $destFile = $this->getFileFTPUrl($new_name);

        if ($context) {
           return rename($sourceFile,$destFile,$context);
        }

        return rename($sourceFile,$destFile);
    }

    public function move($source, $dest, $context = null)
    {
        if ($this->copy($source,$dest,$context)) {
            return ($this->delete($source));
        }

        return false;
    }

    public function delete($filename)
    {
        if (!$this->exists($filename)) return false;
        $file = $this->getFileFTPUrl($filename);

        return unlink($file);
    }

    public function isDirectory($dirname)
    {
        $dir = $this->getFileFTPUrl($dirname);
        return is_dir($dir);
    }

    public function listDirectory($dirname)
    {
        if (!$this->isDirectory($dirname)) return false;
        return $this->listDir($dirname);
    }

    protected function listDir($dir)
    {
        $array_list = array();
        $list = ftp_nlist($this->connection,$dir);
        foreach ($list as $file)
            {
            $pathinfo = pathinfo($file);
            if ($pathinfo['extension'] == '')
                {
                if ($pathinfo['basename'] != '.' and $pathinfo['basename'] != '..')
                    $array_list[$pathinfo['basename']] = $this->listDir($file);
                }
            else
                $array_list[] = $pathinfo['basename'];
            }

        return $array_list;
    }

    public function makeDir($pathname, $mode = 777, $recursive = false, $context = null)
    {
        $pathname = $this->getFileFTPUrl($pathname);
        if ($context) {
            return mkdir($pathname, $mode, $recursive, $context);
        } else {
            return mkdir($pathname, $mode, $recursive);
        }
    }

    public function chmod($target, $right = 777)
    {
        if (!$this->exists($target)) return false;

        return ftp_chmod($this->connection,$right,$this->uploadDir.$target);
    }

    public function deleteDir($pathname)
    {
        if (!$this->isDirectory($pathname)) return true;
        $pathname = $this->getFileFTPUrl($pathname);

        return rmdir($this->uploadDir.$pathname);
    }
}