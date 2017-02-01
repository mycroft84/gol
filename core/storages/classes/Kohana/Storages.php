<?php
/**
 * User: Tibi
 * Date: 2015.10.21.
 * Time: 9:10
 * Project: redmozi_web
 * Company: d2c
 */
abstract class Kohana_Storages
{
    protected static $default = 'default';
    protected static $instances = array();

    public $uploadDir = null;
    protected $baseUrl = null;

    public $remove_spaces = TRUE;

    /**
     * @param null $name
     * @param array|NULL $config
     * @return Storages
     * @throws Kohana_Exception
     */
    public static function instance($name = NULL, array $config = NULL)
    {
        if ($name === NULL)
        {
            // Use the default instance name
            $name = self::$default;
        }

        if ( ! isset(self::$instances[$name]))
        {
            if ($config === NULL)
            {
                $config = Kohana::$config->load('storages')->$name;
            }

            if (!isset($config['type']))
            {
                throw new Kohana_Exception('Storages type not defined in :name configuration',
                    array(':name' => $name));
            }

            $driver = 'Storages_'.ucfirst($config['type']);
            $driver = new $driver($name, $config);

            self::$instances[$name] = $driver;
        }

        return self::$instances[$name];
    }

    public function setUploadDir($dir)
    {
        $this->uploadDir = $dir;
        return $this;
    }

    public function getUploadDir()
    {
        return $this->uploadDir;
    }

    public function isRemoveSpaces()
    {
        return $this->remove_spaces;
    }

    public function setRemoveSpaces($remove_spaces)
    {
        $this->remove_spaces = $remove_spaces;
    }

    abstract public function upload(array $file, $filename = NULL, $directory = NULL, $chmod = 0644);
    abstract public function get($filename);
    abstract public function exists($filename);
    abstract public function copy($source , $dest, $context = null);
    abstract public function rename($source , $new_name, $context = null);
    abstract public function move($source , $dest, $context = null);
    abstract public function delete($filename);
    abstract public function isDirectory($dirname);
    abstract public function listDirectory($dirname);
    abstract public function makeDir($pathname, $mode = 0777, $recursive = false, $context = null);
    abstract public function deleteDir($pathname);
    abstract public function filesize($filename);
    abstract public function createFile($data,$filename);
    abstract public function getRealPath($filename);
    abstract public function getFileContent($filename);

}