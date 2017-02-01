<?php defined('SYSPATH') OR die('No direct script access.');

class Kohana extends Kohana_Core {
	
	static function subtitles($title, $strip = true, $file = 'subtitles')
	{        
        if (empty($title)) return $title;
    
        $subtitle = __($title);
        if ($subtitle == $title) {
            $subtitle = Kohana::message($file,$title,$title);
        }

        return ($strip) ? strip_tags($subtitle) : $subtitle;
	}

    public static function auto_load_namespace($class, $directory = 'classes')
    {
        if (strpos($class,"\\") !== false) {
            $parts = explode('\\',$class);
            if ($parts[0] == 'Backend' || $parts[0] == 'Frontend') $parts = array_slice($parts,1);

            if ($path = Kohana::find_file($directory, join(DIRECTORY_SEPARATOR,$parts)))
            {
                // Load the class file
                require $path;

                // Class has been found
                return TRUE;
            }

            return FALSE;
        }

    }
}
