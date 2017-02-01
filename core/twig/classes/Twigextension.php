<?php
class Twigextension {
    
    static function i18n($tag)
    {
        return Kohana::subtitles($tag);
    }
    
    static function i18nHtml($tag)
    {
        return Kohana::subtitles($tag,false);
    }
    
    static function config($config)
    {
        return Kohana::$config->load($config);
    }
    
    static function pad($str,$length,$padString,$padOption = STR_PAD_LEFT)
    {
        return str_pad($str,$length,$padString,$padOption);
    }
    
    static function in_array($array,$search)
    {
        return in_array($search,$array);
    }
    
    
    static function path($route_name,$uri = false)
    {
        $url = Route::get($route_name);
        $url = ($uri) ? $url->uri($uri) : $url->uri();
        
        return $url;
    }
    
    static function url($route_name,$uri = false)
    {
        return Route::i18nUrl($route_name,$uri);
    }

    static function get_user()
    {
        return Auth::instance()->get_user();
    }

    static function logged_in()
    {
        return Auth::instance()->logged_in();
    }

    static function getImage($src)
    {
        $onlyInclude = Kohana::$config->load('assetmerger.onlyInclude');
        $url = ($onlyInclude) ? URL::base(null,false)."media/images/".$src : URL::base(null,false)."web/images/".$src;

        return $url;
    }

    static function getUserfile($src)
    {
        return (strpos($src,'http') === false) ? Storages::instance()->get($src) : $src;
    }

    public static function mb_strlen($str)
    {
        return mb_strlen($str);
    }

    public static function mb_substr($str, $start, $end)
    {
        return mb_substr($str,$start,$end);
    }

    public static function shortest($str,$len)
    {
        $strlen = mb_strlen($str);
        if ($strlen <= $len) return $str;

        return mb_substr(strip_tags($str),0,$len)."...";
    }

    public static function shortest_word($str,$len)
    {
        $str = trim(strip_tags($str));

        $result = array();
        $count = 0;
        $words = explode(" ",$str);

        foreach($words as $item)
        {
            if (($count + mb_strlen($item) + 1) < $len) {
                $result[] = $item;
                $count+=mb_strlen($item) + 1;
                FB::info($count);
                FB::info($item);
            } else {
                return join(" ",$result)."...";
            }
        }
    }
	
    public static function isGranted($mask,ORM $resource,ORM $user = null)
    {
        if (!$user) $user = Auth::instance()->get_user();

        return Access_Control_List::isGranted($mask, $resource, $user);
    }

    public static function hasRole($role,ORM $user = null)
    {
        return Auth::instance()->hasRole($role,$user);
    }

    public static function checkCurrentMenu($menu, $current)
    {
        $select = false;
        foreach($menu['menu'] as $item)
        {
            if ($current == $menu['sub']."_".$item['name'])
                $select = true;
        }

        return $select;
    }

    public static function chunk($array, $limit)
    {
        return array_chunk($array,$limit);
    }
    
    public static function str_replace($str,$search,$replace)
    {
        return str_replace($search,$replace,$str);
    }
    
    public static function time()
    {
        return time();
    }
}