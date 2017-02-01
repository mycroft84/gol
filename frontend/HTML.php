<?php defined('SYSPATH') OR die('No direct script access.');

class HTML extends Kohana_HTML {

    static function favicon($src)
    {
        if (!isset($src)) return false;

        $onlyInclude = Kohana::$config->load('assetmerger.onlyInclude');
        $url = ($onlyInclude) ? URL::base(null,false)."media/pic/".$src : URL::base(null,false)."web/pic/".$src;

        return "<link rel='shortcut icon' href='".$url."'/>";
    }
	
	static function lipsum($amount = 1, $what = 'paras', $start = 0) {
        return simplexml_load_file("http://www.lipsum.com/feed/xml?amount=$amount&what=$what&start=$start")->lipsum;
    }

    static function getGravatar($email,$size,$type = "retro",$onlyfiles = false)
    {
        $hash = md5(strtolower(trim($email)));
        
        if (!$onlyfiles) return "<img  src='http://www.gravatar.com/avatar/".$hash."?d=".$type."&s=".$size."' />";
        else return "http://www.gravatar.com/avatar/".$hash."?d=".$type."&s=".$size;
    }
    
    static function getFileSize($file)
    {
        if (file_exists($file)) {
            
            return self::_format_bytes(filesize($file));
            
        } else return self::_format_bytes($file);    
    }
        
    private static function _format_bytes($a_bytes,$dec = 2)
    {
        if ($a_bytes < 1024) {
            return $a_bytes .' B';
        } elseif ($a_bytes < 1048576) {
            return round($a_bytes / 1024, $dec) .'kB';
        } elseif ($a_bytes < 1073741824) {
            return round($a_bytes / 1048576, $dec) . 'MB';
        } elseif ($a_bytes < 1099511627776) {
            return round($a_bytes / 1073741824, $dec) . 'GB';
        } elseif ($a_bytes < 1125899906842624) {
            return round($a_bytes / 1099511627776, $dec) .'TB';
        } elseif ($a_bytes < 1152921504606846976) {
            return round($a_bytes / 1125899906842624, $dec) .'PB';
        } elseif ($a_bytes < 1180591620717411303424) {
            return round($a_bytes / 1152921504606846976, $dec) .'EB';
        } elseif ($a_bytes < 1208925819614629174706176) {
            return round($a_bytes / 1180591620717411303424, $dec) .'ZB';
        } else {
            return round($a_bytes / 1208925819614629174706176, $dec) .'YB';
        }
    }
    
    static function createPager($current,$pageNum,$url)
    {
        return Pager::factory()->get(2,$current,$pageNum,$url);
    }
}