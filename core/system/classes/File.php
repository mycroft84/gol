<?php defined('SYSPATH') OR die('No direct script access.');

class File extends Kohana_File {

/**
	* File force download
	* 
	* @param string $filename	Filename
	* @param string $data	Data
	* @param bool $file 	If false data is string, if true it is a real file
	*/
	static function force_download($filename = '', $data = '',$file=false)
	{
		if ($filename == '' OR $data == '')
		{
			return FALSE;
		}
		
		// Try to determine if the filename includes a file extension.
		// We need it in order to set the MIME type
		if (FALSE === strpos($filename, '.'))
		{
			return FALSE;
		}
	
		// Grab the file extension
		$x = explode('.', $filename);
		$extension = end($x);

		// Load the mime types
		$mimes = @include(SYSPATH.'config'.DIRECTORY_SEPARATOR.'mimes'.EXT);
		// Set a default mime if we can't find it
		if ( ! isset($mimes[$extension]))
		{
			$mime = 'application/octet-stream';
		}
		else
		{
			$mime = (is_array($mimes[$extension])) ? $mimes[$extension][0] : $mimes[$extension];
		}

        $filesize = ($file) ? filesize($data) : strlen($data);
		// Generate the server headers
		if (strstr($_SERVER['HTTP_USER_AGENT'], "MSIE"))
		{
			header('Content-Type: "'.$mime.'"');
			header('Content-Disposition: attachment; filename="'.$filename.'"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header("Content-Transfer-Encoding: binary");
			header('Pragma: public');
			header("Content-Length: ".$filesize);
		}
		else
		{
			header('Content-Type: "'.$mime.'"');
			header('Content-Disposition: attachment; filename="'.$filename.'"');
			header("Content-Transfer-Encoding: binary");
			header('Expires: 0');
			header('Pragma: no-cache');
			header("Content-Length: ".$filesize);
		}
	
		if ($file) {
            self::readfile_chunked($data);
            exit();
          
          
		} else {
		  
          exit($data);
		}
	}
    
    static function readfile_chunked($file,$retbytes = true)
    {
        $chunksize = 1 * (1024 * 1024);
       
        $buffer = '';
        $cnt =0;
        
        $handle = fopen($file, 'r');
        if ($handle === FALSE)
        {
           return FALSE;
        }
        
        while (!feof($handle))
        {
           $buffer = fread($handle, $chunksize);
           echo $buffer;
           ob_flush();
           flush();
        
           if ($retbytes)
           {
               $cnt += strlen($buffer);
           }
        }
        
        $status = fclose($handle);
        
        if ($retbytes AND $status)
        {
           return $cnt;
        }
        
        return $status;
    }
	
	static function getFilesName($data,&$res=array())
	{
		$res = array();
		foreach($data as $key=>$item)
		{
			if (is_array($item))
			{
				$res[$key] = array();
				File::getFilesName($item,$res[$key]);
			}
			else
			{
				$matches = explode('\\',$item);
				$res[$key] = end($matches);
			}
			
		}
		
		return $res;
	}
	
	static function getFileExt($filename)
	{
		$data = explode('.',$filename);
		return strtolower(end($data));
	}
    
    static function listDir($dir,$not = array())
    {
        $files = array();
        if ($handle = opendir($dir)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != "..") {
                    if (!in_array($file,$not)){
                        $files[] = $file;
                    }
                }
            }
            closedir($handle);
        }
        
        return $files;
    }
    
    static function fileWrite($patch,$name,$content)
    {
        return file_put_contents($patch.DIRECTORY_SEPARATOR.$name,$content) !== false;
    }
    
    static function fileDelete($file)
    {
        return unlink($file);
    }
    
    static function getFileSize($file)
    {
        if (file_exists($file)) {
            
            return self::fileSizeFormat(filesize($file));
            
        } else return 0;    
    }
        
    static function fileSizeFormat($a_bytes)
    {
        if ($a_bytes < 1024) {
            return $a_bytes .' B';
        } elseif ($a_bytes < 1048576) {
            return round($a_bytes / 1024, 2) .'kB';
        } elseif ($a_bytes < 1073741824) {
            return round($a_bytes / 1048576, 2) . 'MB';
        } elseif ($a_bytes < 1099511627776) {
            return round($a_bytes / 1073741824, 2) . 'GB';
        } elseif ($a_bytes < 1125899906842624) {
            return round($a_bytes / 1099511627776, 2) .'TB';
        } elseif ($a_bytes < 1152921504606846976) {
            return round($a_bytes / 1125899906842624, 2) .'PB';
        } elseif ($a_bytes < 1180591620717411303424) {
            return round($a_bytes / 1152921504606846976, 2) .'EB';
        } elseif ($a_bytes < 1208925819614629174706176) {
            return round($a_bytes / 1180591620717411303424, 2) .'ZB';
        } else {
            return round($a_bytes / 1208925819614629174706176, 2) .'YB';
        }
    }

}