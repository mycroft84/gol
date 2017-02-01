<?php
/**
 * User: MyCroft
 * Company: design2code.hu
 * Product: d2cadmin
 * Date: 2013.05.11.
 * Time: 17:52
 *
 * modul - modul
 * lang - lang
 * target - target
 * text - text
 *
 */

class Task_I18n_Create extends Minion_Task
{
    protected $_options = array(
        'source' => NULL,
        'target' => NULL,
    );

    public function build_validation(Validation $validation)
    {
        return parent::build_validation($validation)
            ->rule('source', 'not_empty')
            ->rule('target', 'not_empty');
    }

    protected function _execute(array $params)
    {
        $dir = APPPATH.'i18n';

        $html = Twig::get_template_content('helpers/i18n.twig',array(
            'subtitles'=>I18n::load($params['source']),
            'target'=>I18n::load($params['target'])
        ));

        file_put_contents($dir.DIRECTORY_SEPARATOR.$params['target'].'_new.php',$html);
    }
}