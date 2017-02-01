<?php defined('SYSPATH') OR die('No direct script access.');

class Image_GD extends Kohana_Image_GD {

    public function __construct($file,$is_data)
    {
        if ( ! Image_GD::$_checked)
        {
            // Run the install check
            Image_GD::check();
        }

        parent::__construct($file,$is_data);

        // Set the image creation function name
        switch ($this->type)
        {
            case IMAGETYPE_JPEG:
                $create = 'imagecreatefromjpeg';
            break;
            case IMAGETYPE_GIF:
                $create = 'imagecreatefromgif';
            break;
            case IMAGETYPE_PNG:
                $create = 'imagecreatefrompng';
            break;
        }

        if ($is_data) $create = 'imagecreatefromstring';

        if ( ! isset($create) OR ! function_exists($create))
        {
            throw new Kohana_Exception('Installed GD does not support :type images',
                array(':type' => image_type_to_extension($this->type, FALSE)));
        }

        // Save function for future use
        $this->_create_function = $create;

        // Save filename for lazy loading
        $this->_image = $this->file;
    }

    public function fill($width, $height, $color, $opacity = 100)
    {
        if ($color[0] === '#')
        {
            // Remove the pound
            $color = substr($color, 1);
        }

        if (strlen($color) === 3)
        {
            // Convert shorthand into longhand hex notation
            $color = preg_replace('/./', '$0$0', $color);
        }

        // Convert the hex into RGB values
        list ($r, $g, $b) = array_map('hexdec', str_split($color, 2));

        // The opacity must be in the range of 0 to 100
        $opacity = min(max($opacity, 0), 100);

        $this->_do_fill($width, $height, $r, $g, $b, $opacity);

        //echo Debug::vars('itt');

        return $this;
    }

    protected function _do_fill($width, $height, $r, $g, $b, $opacity)
    {
        // Loads image if not yet loaded
        $this->_load_image();

        // Convert an opacity range of 0-100 to 127-0
        $opacity = round(abs(($opacity * 127 / 100) - 127));

        // Create a new background
        $background = $this->_create($width, $height);

        // Allocate the color
        $color = imagecolorallocatealpha($background, $r, $g, $b, $opacity);

        // Fill the image with white
        imagefilledrectangle($background, 0, 0, $width, $height, $color);

        // Alpha blending must be enabled on the background!
        imagealphablending($background, TRUE);

        $src_x = 0;
        $src_y = 0;
        if ( $this->width < $width ) { $src_x = ($width - $this->width) / 2; }
        if ( $this->height < $height ) { $src_y = ($height - $this->height) / 2; }

        // Copy the image onto a white background to remove all transparency
        if (imagecopy($background, $this->_image, $src_x, $src_y, 0, 0, $this->width, $this->height))
        {
            // Swap the new image for the old one
            imagedestroy($this->_image);
            $this->_image = $background;
        }
    }

}
