<?php
/**
 * User: MyCroft
 * Date: 2014.02.10.
 * Time: 10:40
 * Project: d2cadmin3.3
 * Company: d2c
 */
class Containers_File_Thumbs extends Containers
{
    private $thumbs = array();
    private $default = "default.png";
    private $customDefault = false;

    public function setThumb($width,$height,$url)
    {
        if (!array_key_exists($width,$this->thumbs)) $this->thumbs[$width] = array();
        if (!array_key_exists($height,$this->thumbs[$width])) $this->thumbs[$width][$height] = array();

        $this->thumbs[$width][$height] = $url;

        return $this;
    }

    public function getThumb($width,$height,$thumb = false)
    {
        if ($thumb) $this->customDefault = $thumb;

        if (!array_key_exists($width,$this->thumbs) or !array_key_exists($height,$this->thumbs[$width])) {
            return Twigextension::getImage($this->getThumbFilename($this->default,$width,$height));
        }

        return Twigextension::getUserfile($this->thumbs[$width][$height]);
    }

    public function getThumbFilename($name,$width,$height)
    {
        if ($this->customDefault === false) {
            $pos = strrpos($name,'.');
            $fileName = substr($name,0,$pos);
            $ext = substr($name,$pos+1);

            return $fileName."_thum_".$width."x".$height.".".$ext;
        } else {
            return $this->customDefault;
        }

    }
    
    public function getAllThumbs()
    {
       return $this->thumbs;
    }

}