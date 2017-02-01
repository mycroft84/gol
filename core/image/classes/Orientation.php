<?php
/*
 * PHP Orientation Fix (GD) v1.0.0
 * https://github.com/leesherwood/Orientation-Fix-PHP
 *
 * Copyright 2013, "leesherwood" Lee Sherwood
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 *
 * AKA: I couldn't care less what you do with it, 
 *      im just a nice guy and i want to share.
 *      But it would be nice if you left me a little credit :)
 *
 * If you use this, then let me know at: i-played-with-your-git@secure4sure.org
 */

/**
 * The main function that does the actual job
 * 
 * Pass a string representing the image path and filename such as /var/www/images/image.jpg
 * And it will change the name of the image to include "orig." (for the sake of not deleting your image if something goes wrong)
 * and then create a new image with the same filename, with the orientation fixed
 * The return bool is not informative and should only be used to to tell your script that there is a proper orientated image available (or not)
 * If you want to know why it failed (theres many reason) then you need to make the return values for informative, or use exceptions.     
 *   
 * @param string the path to the file including the file iteself (absolute path would be advised)
 * @return bool true if successful, false if not
 */
class Orientation
{
    protected $filename;

    public static function factory($filename)
    {
        $ori = new Orientation($filename);
        return $ori;
    }

    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    public function fix()
    {
        if(!file_exists($this->filename))
        return false;

        $exif = @read_exif_data($this->filename, 'IFD0');
        if(!$exif || !is_array($exif))
            return false;

        $exif = array_change_key_case($exif, CASE_LOWER);

        if(!array_key_exists('orientation', $exif))
            return false;

        // Gets the GD image resource for loaded image
        $img_res = $this->get_image_resource($this->filename);

        if(is_null($img_res))
            return false;

        switch($exif['orientation'])
        {
            case 1: return true; break;

            case 2:
                $final_img = $this->imageflip($img_res, IMG_FLIP_HORIZONTAL);
                break;

            case 3:
                $final_img = $this->imageflip($img_res, IMG_FLIP_VERTICAL);
                break;

            case 4:
                $final_img = $this->imageflip($img_res, IMG_FLIP_BOTH);
                break;

            case 5:
                $img_res = imagerotate($img_res, -90, 0);
                $final_img = $this->imageflip($img_res, IMG_FLIP_HORIZONTAL);
                break;

            case 6:
                $final_img = imagerotate($img_res, -90, 0);
                break;

            case 7:
                $img_res = imagerotate($img_res, 90, 0);
                $final_img = $this->imageflip($img_res,IMG_FLIP_HORIZONTAL);
                break;

            case 8:
                $final_img = imagerotate($img_res, 90, 0);
                break;
        }

        if(!isset($final_img))
            return false;

        //-- rename original (very ugly, could probably be rewritten, but i can't be arsed at this stage)
        $parts = explode("/", $this->filename);
        $oldname = array_pop($parts);
        $path = implode('/', $parts);
        $oldname_parts = explode(".", $oldname);
        $ext = array_pop($oldname_parts);
        $newname = implode('.', $oldname_parts).'.orig.'.$ext;

        rename($this->filename, $newname);

        // Save it and the return the result (true or false)
        $done = $this->save_image_resource($final_img,$this->filename);

        return $done;
    }

    protected function get_image_resource($file) {

        $img = null;
        $p = explode(".", strtolower($file));
        $ext = array_pop($p);
        switch($ext) {

          case "png":
            $img = imagecreatefrompng($file);
            break;

          case "jpg":
          case "jpeg":
            $img = imagecreatefromjpeg($file);
            break;
          case "gif":
            $img = imagecreatefromgif($file);
            break;

        }

        return $img;
    }

    protected function save_image_resource($resource, $location) {

        $success = false;
        $p = explode(".", strtolower($location));
        $ext = array_pop($p);
        switch($ext) {

          case "png":
            $success = imagepng($resource,$location);
            break;

          case "jpg":
          case "jpeg":
            $success = imagejpeg($resource,$location);
            break;
          case "gif":
            $success = imagegif($resource,$location);
            break;

        }

        return $success;

    }

    protected function imageflip($resource, $mode) {

          if($mode == IMG_FLIP_VERTICAL || $mode == IMG_FLIP_BOTH)
            $resource = imagerotate($resource, 180, 0);

          if($mode == IMG_FLIP_HORIZONTAL || $mode == IMG_FLIP_BOTH)
            $resource = imagerotate($resource, 90, 0);

          return $resource;

    }
}