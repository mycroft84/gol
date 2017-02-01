<?php defined('SYSPATH') or die('No direct script access.');
/**
* Input class
*/
class Input
{
	/**
	* Get the $_POST[$key] element with xss_clean and encode_php_tags
	* 
	* @param mixed $key
	* @return string
	*/
	static function post($key)
	{
		$post = array_merge($_POST,$_FILES);
		if (!isset($post) || empty($post)) return false;

		$result = (isset($post[$key])) ? Security::xss_clean(Security::encode_php_tags($post[$key])) : false;

		return (is_array($result)) ? $result : trim($result);
	}
	
	/**
	* Get $_POST array with xss_clean and encode_php_tags
	* 
	* @return array
	*/
	static function post_all($has_lang = false)
	{
	    $post = array_merge($_POST,$_FILES);   
		if (!isset($post) || empty($post)) return array();
		
		$res = array();
		foreach($post as $key=>$value)
		{
			if (!is_array($value)) {
                $key = Security::xss_clean(Security::encode_php_tags($key));
                if ($has_lang) {
                    $parts = explode("_lang_",$key);
                    if (count($parts) > 1) {
                        $res[$parts[0]][$parts[1]] = trim(Security::xss_clean(Security::encode_php_tags($value)));
                    } else {
                        $res[$key] = trim(Security::xss_clean(Security::encode_php_tags($value)));
                    }

                } else {
                    $res[$key] = trim(Security::xss_clean(Security::encode_php_tags($value)));
                }
            }
            else  {
                $temp = array();
                foreach($value as $value_key => $value_item)
                {
                    if (!is_array($value_item))
                        $temp[Security::xss_clean(Security::encode_php_tags($value_key))] = trim(Security::xss_clean(Security::encode_php_tags($value_item)));
                    else
                        $temp[Security::xss_clean(Security::encode_php_tags($value_key))] = $value_item;
                }

                $res[Security::xss_clean(Security::encode_php_tags($key))] = $temp;
            }
                
		}


        $res['userFiles'] = array(); 
        foreach($_FILES as $index=>$item)
        {
            if (!is_array($item['name']))
            {
                $item['inputName'] = $index;
                $res['userFiles'][$index] = $item;   
            }
            else {
                
                foreach($item['name'] as $nIndex=>$nValue)
                {
                    if (!is_array($nValue)) {
                        if ($item['error'][$nIndex] == 0)
                        {
                            $file = array(
                                'name'=>$item['name'][$nIndex],
                                'type'=>$item['type'][$nIndex],
                                'tmp_name'=>$item['tmp_name'][$nIndex],
                                'error'=>$item['error'][$nIndex],
                                'size'=>$item['size'][$nIndex],
                                'inputName'=>$index
                            );

                            $res['userFiles'][$index.'_'.$nIndex] = $file;
                        }
                    } else {
                        foreach ($nValue as $nnIndex => $nnValue) {
                            $file = array(
                                'name'=>$item['name'][$nIndex][$nnIndex],
                                'type'=>$item['type'][$nIndex][$nnIndex],
                                'tmp_name'=>$item['tmp_name'][$nIndex][$nnIndex],
                                'error'=>$item['error'][$nIndex][$nnIndex],
                                'size'=>$item['size'][$nIndex][$nnIndex],
                                'inputName'=>$index
                            );

                            $res['userFiles'][$index][$nIndex][$index.'_'.$nnIndex] = $file;
                        }
                    }
                }
            }
        }

		if (isset($_POST['upload_files'])) {

			foreach($_POST['upload_files'] as $index=>$item)
			{
				if (is_array($item)) {
					foreach ($item as $fIndex=>$fItem) {
						$parts = explode(",",$fItem);
						$file = array(
							'name'=>$_POST['upload_filename'][$index][$fIndex],
							'original_name'=>$_POST['upload_original_name'][$index][$fIndex],
							'type'=>$_POST['upload_mime'][$index][$fIndex],
							'size'=>$_POST['upload_filesize'][$index][$fIndex],
							'details'=>$_POST['upload_filedetails'][$index][$fIndex],
							'types'=>$_POST['upload_filetypes'][$index][$fIndex],
							'data'=>end($parts),
							'inputName'=>$index,
							'base64'=>true,
						);

						$res['userFiles'][$index.'_'.$fIndex] = $file;
					}
				} else {
					$parts = explode(",",$item);
					$file = array(
						'name'=>$_POST['upload_filename'][$index],
						'original_name'=>$_POST['upload_original_name'][$index],
						'type'=>$_POST['upload_mime'][$index],
						'size'=>$_POST['upload_filesize'][$index],
						'details'=>$_POST['upload_filedetails'][$index],
						'types'=>$_POST['upload_filetypes'][$index],
						'data'=>end($parts),
						'inputName'=>$index,
						'base64'=>true,
					);

					$res['userFiles'][$index] = $file;

				}
			}
		}

		return $res;
	}
	
	static function post_this($data)
	{
		$post = array_merge($_POST,$_FILES);
        if (!isset($post) || empty($post)) return array();
		if (!is_array($data)) return Input::post_all();
		
		$res = array();
		foreach($post as $key=>$value)
		{
			if (in_array($key,$data))
				$res[Security::xss_clean(Security::encode_php_tags($key))] = Security::xss_clean(Security::encode_php_tags($value));
		}
		
		return $res;
		
	}
	
	/**
	* Get $_GET[$key] element with xss_clean and encode_php_tags
	* 
	* @param mixed $key
	* @return string
	*/
	static function get($key)
	{
		if (empty($_GET)) return false;
		return (isset($_GET[$key])) ? Security::xss_clean(Security::encode_php_tags($_GET[$key])) : false;
	}
	
	/**
	* Get $_GET array with xss_clean and encode_php_tags
	* 
	* @return array
	*/
	static function get_all()
	{
		if (!isset($_GET)|| empty($_GET)) return array();
		
		$res = array();
		foreach($_GET as $key=>$value)
		{
			$res[Security::xss_clean(Security::encode_php_tags($key))] = Security::xss_clean(Security::encode_php_tags($value));
		}
		
		return $res;
	}
	
	static function server()
	{
		return $_SERVER;
	}
	
	static function ip_address()
	{
		 if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
	    {
	      $ip=$_SERVER['HTTP_CLIENT_IP'];
	    }
	    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
	    {
	      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	    }
	    else
	    {
	      $ip=$_SERVER['REMOTE_ADDR'];
	    }
	    return $ip;

	}
}
