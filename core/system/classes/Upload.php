<?php defined('SYSPATH') OR die('No direct script access.');

class Upload extends Kohana_Upload {

    public static function image(array $file, $max_width = NULL, $max_height = NULL, $exact = FALSE)
    {
        if (Upload::not_empty($file) or isset($file['base64']))
        {
            try
            {
                // Get the width and height from the uploaded image
                if ((!isset($file['base64']))) {
                    list($width, $height) = getimagesize($file['tmp_name']);
                } else {
                    $resource = imagecreatefromstring(base64_decode($file['data']));
                    $width = imagesx($resource);
                    $height = imagesy($resource);
                }

            }
            catch (ErrorException $e)
            {
                // Ignore read errors
            }

            if (empty($width) OR empty($height))
            {
                // Cannot get image size, cannot validate
                return FALSE;
            }

            if ( ! $max_width)
            {
                // No limit, use the image width
                $max_width = $width;
            }

            if ( ! $max_height)
            {
                // No limit, use the image height
                $max_height = $height;
            }

            if ($exact)
            {
                // Check if dimensions match exactly
                return ($width === $max_width AND $height === $max_height);
            }
            else
            {
                // Check if size is within maximum dimensions
                return ($width <= $max_width AND $height <= $max_height);
            }
        }

        return FALSE;
    }

}
