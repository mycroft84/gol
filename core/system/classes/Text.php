<?php defined('SYSPATH') or die('No direct script access.');

class Text extends Kohana_Text {
	
	public static function encode_chars($string,$from = 'iso-8859-2',$to = 'utf-8')
	{
		return iconv($from,$to,$string);
	}


	public static function decode_chars($string,$from = 'utf-8',$to = 'iso-8859-2')
	{
		return iconv($from,$to,$string);
	}
	
	public static function autoencode_char($array,&$res=array(),$from = 'iso-8859-2',$to = 'utf-8')
	{
		if (!is_array($array)) return $array;
		
		foreach($array as $key=>$item)
		{
			if (is_array($item)){
			   $res[$key]=array();
			   self::autoencode_char($item,$res[$key],$from,$to);
			}
			else $res[$key]=(!is_bool($item)) ? iconv($from,$to,$item) : $item;
		}
		
		return $res;
	}

	public static function autodecode_char($array,&$res=array(),$from = 'utf-8',$to = 'iso-8859-2')
	{
		if (!is_array($array)) return $array;
		
	   	foreach($array as $key=>$item)
		{
			if (is_array($item)){
			   $res[$key]=array();
			   self::autodecode_char($item,$res[$key],$from,$to);
			}
			else $res[$key]=(!is_bool($item)) ? iconv($from,$to,$item) : $item;
		}
		
		return $res;
	}
    
    static function generatePassword($length=10, $strength=4) {
    	$vowels = 'aeuy';
    	$consonants = 'bdghjmnpqrstvz';
    	if (isset($strength) and $strength >= 1) {
    		$consonants .= 'BDGHJLMNPQRSTVWXZ';
    	}
    	if (isset($strength) and $strength >= 2) {
    		$vowels .= "AEUY";
    	}
    	if (isset($strength) and $strength >= 4) {
    		$consonants .= '23456789';
    	}
    	if (isset($strength) and $strength >= 8) {
    		$consonants .= '@#$%';
    	}
     
    	$password = '';
    	$alt = time() % 2;
    	for ($i = 0; $i < $length; $i++) {
    		if ($alt == 1) {
    			$password .= $consonants[(rand() % strlen($consonants))];
    			$alt = 0;
    		} else {
    			$password .= $vowels[(rand() % strlen($vowels))];
    			$alt = 1;
    		}
    	}
    	return $password;
    }
    
    static function strfind($search, $target)
    {
        $is = false;
        if (!is_array($search)) $is = strpos($target,$search);
        else {
            foreach($search as $item)
            {
                $is = $is || (strpos($target,$item) !== false);
            }
        }
        
        if ($is === false) return false;
        else return true;
    }
	
    static function getTextBetweenTags($string, $tagname) {
            $pattern = "/<$tagname>(.*?)<\/$tagname>/";
            preg_match($pattern, $string, $matches);
            return $matches[1];
    }
    
    static function compress($string)
    {
        return rtrim(strtr(base64_encode(gzdeflate($string, 9)), '+/', '-_'), '=');
    }
    
    static function decompress($compressed)
    {
        return ($compressed != '') ? gzinflate(base64_decode(strtr($compressed, '-_', '+/'))) : '';
    }

    static function json_decode($string,$file = false,$as_array = true)
    {
        if ($file) {
            $search = array("\r\n", "\n", "\r","\t");
            $replace = array("","","","");
            
            $string = str_replace($search,$replace,file_get_contents($string));
        }
        
        $data = json_decode($string,$as_array);
        $error = "";
        switch (json_last_error()) 
        {
            case JSON_ERROR_DEPTH:
                $error = Kohana::subtitles('jsonErrorDepth');
                break;
                
            case JSON_ERROR_STATE_MISMATCH:
                $error = Kohana::subtitles('jsonErrorStateMismatch');
                break;
                
            case JSON_ERROR_CTRL_CHAR:
                $error = Kohana::subtitles('jsonErrorCtrlChar');
                break;
                
            case JSON_ERROR_SYNTAX:
                if (mb_detect_encoding($string) == "UTF-8")
                {
                    $data = json_decode(substr($string,3),true);
                    if (json_last_error() != JSON_ERROR_NONE) $error = Kohana::subtitles('jsonErrorSyntax');
                    
                } else $error = Kohana::subtitles('jsonErrorDepth');
                break;
                
            case JSON_ERROR_UTF8:
                $error = Kohana::subtitles('jsonErrorUtf8');
                break;
            
            case JSON_ERROR_NONE:
            default: 
                $error = "";
                break;
            
        }
        if ($data) return $data;
        else return array('error'=>true,'message'=>$error);
    }
    
    static function toAscii($str, $delimiter='_')
    {
         $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
         $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
         $clean = strtolower(trim($clean, '-'));
         $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
        
         return $clean;
    }
		
}
