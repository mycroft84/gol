<?php
/**
 * User: Tibi
 * Date: 2014.07.23.
 * Time: 12:30
 * Project: zalanka.hu
 * Company: d2c
 */
class Task_Assets_Pics_Size_Export extends Minion_Task
{
    protected $_options = array(
    );

    public function build_validation(Validation $validation) {
        return parent::build_validation($validation);
    }

    protected function _execute(array $params)
    {
        $settings = Kohana::$config->load('settings');
        $result = array();
        foreach($settings as $index=>$item)
        {
            if (strpos($index,'PicWidth') !== false || strpos($index,'PicHeight') !== false) {
                $result[$index] = $item;
            }
        }

        $str = Twig::get_template_content('moduletemplates/picsizeexport.twig',array('data'=>$result));
        file_put_contents('../frontend/application/config/pic_width.php',$str);
    }

}