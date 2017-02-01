<?php
/**
 * User: Tibi
 * Date: 2014.07.28.
 * Time: 10:13
 * Project: zalanka.hu
 * Company: d2c
 */
class Task_Assets_Pics_Size_Create extends Minion_Task
{
    protected $_options = array(
        'table' => NULL,
        'force'=>false
    );

    public function build_validation(Validation $validation) {
        return parent::build_validation($validation)
            ->rule('table', 'not_empty');
    }

    protected function _execute(array $params)
    {
        $width = Kohana::$config->load('settings.'.$params['table'].'PicWidth');
        $height = Kohana::$config->load('settings.'.$params['table'].'PicHeight');
        $crops = Kohana::$config->load('settings.'.$params['table'].'PicCrops');
        $watermark = Kohana::$config->load('settings.'.$params['table'].'PicWatermark');

        if (!is_array($crops)) $crops = array();
        if (!is_array($watermark)) $watermark = array();

        ob_end_flush();
        if (is_array($width) and is_array($height)) {

            $files = ORM::factory('Files')
                ->where('fi_table','=',$params['table'])
                ->find_all();

            foreach($files as $item) {
                $currentfile = str_replace('/',DIRECTORY_SEPARATOR,$item->fi_url);
                $currentParts = explode('/',$currentfile);

                if (Storages::instance()->exists($currentfile) and strpos($item->fi_type,'image') !== false) {
                    foreach($width as $wIndex=>$wValue)
                    {
                        $parts = explode('.',$item->fi_url);
                        $resolution = "_thum_".$wValue."x".$height[$wIndex];
                        $thumb = str_replace('/',DIRECTORY_SEPARATOR,$parts[0].$resolution.".".$parts[1]);

                        if ($params['force'] == false and Storages::instance()->exists($thumb)) {
                            echo $thumb." already exits\n";
                        } else {
                            $currentCrops = (isset($crops[$wValue]) and isset($crops[$wValue][$height[$wIndex]])) ? $crops[$wValue][$height[$wIndex]] : array('type'=>Image::CROP);
                            $cWatermark = (array_key_exists($wValue,$watermark) and array_key_exists($height[$wIndex],$watermark[$wValue])) ? $watermark[$wValue][$height[$wIndex]] : array();

                            try {

                                Image::createThum(
                                    Storages::instance()->getFileContent($currentfile),
                                    $wValue,
                                    $height[$wIndex],
                                    $currentfile,
                                    "_" . $wValue . "x" . $height[$wIndex],
                                    $currentCrops,
                                    $cWatermark
                                );
                                echo $thumb . " thumb created\n";

                            } catch (Exception $e) {}
                        }
                    }
                }
            }

        } else {
            echo "Picsize in not defined for this table!";
        }
        ob_start();

    }

}
