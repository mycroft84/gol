<?php
/**
 * User: MyCroft
 * Date: 2013.07.04.
 * Time: 20:04
 * Company: d2c
 */
class Kohana_Imap_Attachment
{

    public $filename;
    public $ext;
    public $size;
    public $mime;

    private $context;


    public static function factory(stdClass $details, $data)
    {
        $at = new Kohana_Imap_Attachment();
        $at->filename = $at->getFilename($details->parameters);
        $at->ext = $at->getExt();
        $at->size = $details->bytes;
        $at->mime = $details->subtype;

        $at->context = $data;

        return $at;
    }

    private function getFilename($params)
    {
        $filename = "filename";
        foreach($params as $item)
        {
            if ($item->attribute == "NAME") {
                $filename = $item->value;
            }
        }

        return $filename;
    }

    private function getExt()
    {
        $temp = explode('.',$this->filename);
        return end($temp);
    }

    public function download()
    {
        File::force_download($this->filename,$this->context);
    }

    public function save($path,$name = false)
    {
        if ($name === false) $name = $this->filename;

        return file_put_contents($path.DIRECTORY_SEPARATOR.$name,$this->context);
    }

}