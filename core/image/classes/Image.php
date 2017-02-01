<?php defined('SYSPATH') OR die('No direct script access.');

abstract class Image extends Kohana_Image {

    CONST NOTHING = 0;
    CONST CROP = 1;
    CONST FILL = 2;
    CONST RESIZE = 3;

    protected $is_data = false;

    public static function factory($file,$is_data = false, $driver = NULL)
    {
        if ($driver === NULL)
        {
            // Use the default driver
            $driver = Image::$default_driver;
        }

        // Set the class name
        $class = 'Image_'.$driver;

        return new $class($file,$is_data);
    }

    public function __construct($file,$is_data)
    {
        if ($is_data == false) {
            try {
                // Get the real path to the file
                $file = realpath($file);

                // Get the image information
                $info = getimagesize($file);
            } catch (Exception $e) {
                // Ignore all errors while reading the image
            }

            if (empty($file) OR empty($info)) {
                throw new Kohana_Exception('Not an image or invalid image: :file',
                    array(':file' => Debug::path($file)));
            }
        } else {
            try {
                // Get the real path to the file
                $info = getimagesizefromstring($file);

            } catch (Exception $e) {
                // Ignore all errors while reading the image
            }

            if (empty($info)) {
                throw new Kohana_Exception('Not an image or invalid image: :file',
                    array(':file' => Debug::path($file)));
            }
        }

        // Store the image information
        $this->file   = $file;
        $this->width  = $info[0];
        $this->height = $info[1];
        $this->type   = $info[2];
        $this->is_data = $is_data;
        $this->mime   = image_type_to_mime_type($this->type);
    }

    /**
     * @param $file
     * @param int $width
     * @param int $height
     * @param bool|false $namePrefix
     * @param array $crops
     * settings.newsPicCrops = array(
     *    $width=>array(
     *       $height=>array(
     *           'type'=>Image::CROP,
     *       ),
     *       $height=>array(
     *           'type'=>Image::FILL,
     *           'color'=>'aaaaaa',
     *       ),
     *    )
     * )
     *
     * @param array $watermark
     * settings.newsPicWatermark = array(
     *    $width=>array(
     *       $height=>array(
     *           'pic'=>file realpath,
     *           'offset_x'=>10,
     *           'offset_y'=>10,
     *           'opacity'=>100,
     *       ),
     *    )
     * )
     *
     * @return bool|mixed
     * @throws Kohana_Exception
     */
    static function createThum($file,$width = 100, $height = 100,$filename, $namePrefix = false,array $crops = array(),array $watermark = array())
    {
        $image = Image::factory($file, true);
        $ext = File::getFileExt($filename);

        $cropScale = $width/$height;
        $picScale = $image->width / $image->height;

        if (!is_array($crops)) {
            $crops = array('type'=>self::CROP);
        }

        if ($crops['type'] == self::NOTHING) return false;

        if ($crops['type'] == self::CROP) {
            if ($picScale > $cropScale){
                $image->resize(null,$height);

                $offset_x = ($image->width - $width)/2;
                $offset_x = ($offset_x > 0) ? $offset_x : 0;
                $offset_y = null;
            }
            else {
                $image->resize($width,null);

                $offset_x = null;
                $offset_y = ($image->height - $height)/2;
                $offset_y = ($offset_y > 0) ? $offset_y : 0;
            }
        } else {
            if ($picScale < $cropScale){
                $image->resize(null,$height);

                $offset_x = ($image->width - $width)/2;
                $offset_x = ($offset_x > 0) ? $offset_x : 0;
                $offset_y = null;
            }
            else {
                $image->resize($width,null);

                $offset_x = null;
                $offset_y = ($image->height - $height)/2;
                $offset_y = ($offset_y > 0) ? $offset_y : 0;
            }
        }

        switch($crops['type'])
        {
            case Image::CROP:
                $image->crop($width,$height,$offset_x,$offset_y);
                break;

            case Image::FILL:
                $color = (isset($crops['color'])) ? $crops['color'] : 'ffffff';
                $image->fill($width,$height,$color);
                break;
        }

        if(!empty($watermark)) {
            $waterfile = realpath(APPPATH.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."media".DIRECTORY_SEPARATOR."images").DIRECTORY_SEPARATOR.str_replace('/',DIRECTORY_SEPARATOR,$watermark['pic']);

            if(is_file($file)) {
                $mark = Image::factory($waterfile);
                $image->watermark(
                    $mark,
                    (isset($watermark['offset_x'])) ? $watermark['offset_x'] : null,
                    (isset($watermark['offset_y'])) ? $watermark['offset_y'] : null,
                    (isset($watermark['opacity'])) ? $watermark['opacity'] : 100
                );
            }
        }

        $data = $image->render();
        Storages::instance()->createFile($data,str_replace('.'.$ext,'_thum'.$namePrefix.'.'.$ext,strtolower($filename)));

        return str_replace('.'.$ext,"_thum".$namePrefix.".".$ext,strtolower($filename));
    }

    static function resizeAndCrop($file,$width,$height,$cropStartX,$cropStartY,$cropEndX,$cropEndY)
    {
        $image = Image::factory($file);
        $ext = File::getFileExt($file);

        $image->resize($width,$height);
        $image->crop($cropEndX - $cropStartX,$cropEndY - $cropStartY,$cropStartX,$cropStartY);

        $cropWidth = $cropEndX - $cropStartX;
        $cropHeigth = $cropEndY - $cropStartY;

        $image->save(str_replace('.'.$ext,'',$file)."_thum_".$cropWidth."x".$cropHeigth.".".$ext);

        return str_replace('.'.$ext,'',$file)."_thum_".$cropWidth."x".$cropHeigth.".".$ext;
    }

}
