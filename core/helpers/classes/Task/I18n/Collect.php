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

class Task_I18n_Collect extends Minion_Task
{
    protected $subtitles = array();
    protected $files = array();
    protected $searchFolder = array('views','classes','js');
    protected $target = null;

    protected $loaded = array();

    protected $_options = array(
        'target' => NULL,
    );

    public function build_validation(Validation $validation)
    {
        return parent::build_validation($validation)
            ->rule('target', 'not_empty')
        ;
    }

    protected function _execute(array $params)
    {
        $this->target = $params['target'];
        $this->loaded = I18n::load($this->target);

        $modules = $this->getDirectorys();
        foreach($modules as $item)
        {
            $this->getFiles($item);
        }

        $this->writeFile();
    }

    protected function getDirectorys()
    {
        $modules = array(
            APPPATH.'views',
            APPPATH.'classes',
            realpath(APPPATH.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.'media',
        );
        foreach(Kohana::modules() as $item)
        {
            foreach ($this->searchFolder as $folder)
            {
                $dir = $item.$folder;
                if (is_dir($dir))
                {
                    $modules[] = $dir;
                }
            }
        }

        return $modules;
    }

    protected function getFiles($folder)
    {
        $objects = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($folder),
            RecursiveIteratorIterator::SELF_FIRST);

        foreach($objects as $name => $object)
        {
            if ($object->isFile())
            {
                if ($object->getExtension() == 'twig' || $object->getExtension() == 'php' || $object->getExtension() == 'js')
                {
                    $this->searchInFile($object->getPathname());
                }
            }
        }
    }

    protected function searchInFile($file)
    {
        $content = file_get_contents($file);

        $this->processLikeTwig($content);
        $this->processLikeJs($content);
        $this->processLikePHP($content);
    }

    public function processLikeTwig($content)
    {
        preg_match_all("/{{\s*[',\"](.*)[',\"]\|i18n\s*}}/", $content, $output_array);

        if (!empty($output_array[1])) {
            foreach ($output_array[1] as $item) {
                if (!in_array($item,$this->subtitles)) {
                    $this->subtitles[] = $item;
                }
            }
        }
    }

    public function processLikeJs($content)
    {
        preg_match_all("/jsI18n.get\(\s*[',\"](.*)[',\"]\s*\)/", $content, $output_array);

        if (!empty($output_array[1])) {
            foreach ($output_array[1] as $item) {
                if (!in_array($item,$this->subtitles)) {
                    $this->subtitles[] = $item;
                }
            }
        }
    }

    public function processLikePHP($content)
    {
        preg_match_all("/Kohana::subtitles\(\s*[',\"](.*?)[',\"]*\s*\)/", $content, $output_array);

        if (!empty($output_array[1])) {
            foreach ($output_array[1] as $item) {
                if (!in_array($item,$this->subtitles)) {
                    $this->subtitles[] = $item;
                }
            }
        }
    }

    protected function writeFile()
    {
        $dir = APPPATH.'i18n';

        $html = Twig::get_template_content('helpers/i18n_collect.twig',array(
            'subtitles'=>$this->subtitles,
            'loaded'=>$this->loaded,
        ));

        file_put_contents($dir.DIRECTORY_SEPARATOR.$this->target.'_collect.php',$html);
    }
}