<?php
/**
 * User: Tibi
 * Date: 2015.10.21.
 * Time: 9:22
 * Project: redmozi_web
 * Company: d2c
 */
class Kohana_Storages_Local extends Storages
{

    function __construct($name, $config)
    {
        $this->uploadDir = $config['uploadDir'];
        $this->baseUrl =$config['baseUrl'];
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

        if ( ! is_dir($directory) OR ! is_writable(realpath($directory)))
        {
            throw new Kohana_Exception('Directory :dir must be writable',
                array(':dir' => Debug::path($directory)));
        }

        // Make the filename into a complete path
        $filename = realpath($directory).DIRECTORY_SEPARATOR.$filename;

        if (move_uploaded_file($file['tmp_name'], $filename))
        {
            if ($chmod !== FALSE)
            {
                // Set permissions on filename
                chmod($filename, $chmod);
            }

            // Return new file path
            return $filename;
        }

        return FALSE;
    }

    public function get($filename)
    {
        //if (!$this->exists($filename)) return FALSE;
        return  $this->baseUrl.$filename;
    }

    public function getRealPath($filename)
    {
        if (!$this->exists($filename)) return FALSE;
        return  $this->uploadDir.$filename;
    }

    public function exists($filename)
    {
        return is_file($this->uploadDir.$filename);
    }

    public function filesize($filename)
    {
        //if (!$this->exists($filename)) return 0;
        return @filesize($this->getRealPath($filename));
    }

    public function getFileContent($filename)
    {
        if (!$this->exists($filename)) return "";
        return file_get_contents($this->get($filename));
    }

    public function createFile($data,$filename)
    {
        return file_put_contents($this->uploadDir.$filename,$data);
    }

    public function copy($source , $dest, $context = null)
    {
        $sourceFile = $this->uploadDir.$source;
        if (!$this->exists($source)) return false;

        $destFile = $this->uploadDir.$dest;

        if ($context) {
            return copy($sourceFile,$destFile,$context);
        }

        return copy($sourceFile,$destFile);
    }

    public function rename($source , $new_name, $context = null)
    {
        $sourceFile = $this->uploadDir.$source;
        if (!$this->exists($source)) return false;

        if ($context) {
            return rename($sourceFile,$new_name,$context);
        }

        return rename($sourceFile,$new_name);
    }

    public function move($source , $dest, $context = null)
    {
        if ($this->copy($source,$dest,$context)) {
            return ($this->delete($source));
        }

        return false;
    }

    public function delete($filename)
    {
        if (!$this->exists($filename)) return false;
        return unlink($this->uploadDir.$filename);
    }

    public function isDirectory($dirname)
    {
        return (is_dir($this->uploadDir.$dirname));
    }

    public function listDirectory($dirname,$is_recursive = false)
    {
        if (!$this->isDirectory($dirname)) return false;
        return ($is_recursive) ? new RecursiveIteratorIterator(new RecursiveDirectoryIterator($this->uploadDir.$dirname), RecursiveIteratorIterator::SELF_FIRST) : scandir($this->uploadDir.$dirname);
    }


    public function makeDir($pathname, $mode = 777, $recursive = false, $context = null)
    {
        if ($this->isDirectory($pathname)) return true;

        if ($context) {
            return mkdir($this->uploadDir.$pathname, $mode, $recursive, $context);
        } else {
            return mkdir($this->uploadDir.$pathname, $mode, $recursive);
        }
    }


    public function deleteDir($pathname)
    {
        if (!$this->isDirectory($pathname)) return true;

        return rmdir($this->uploadDir.$pathname);
    }
}