<?php
/**
 * User: Tibor
 * Date: 2016.01.21.
 * Time: 18:17
 * Project: enigma
 * Company: d2c
 */
class Task_Phpstorm_Meta extends Minion_Task
{
    protected $files = array();
    protected $searchFolder = array('classes\Model');

    protected $loaded = array();

    protected $_options = array(
    );

    public function build_validation(Validation $validation)
    {
        return parent::build_validation($validation)
        ;
    }

    protected function _execute(array $params)
    {
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
            APPPATH.'classes'.DIRECTORY_SEPARATOR.'Model',
            realpath(APPPATH.'/../../frontend/application/classes/Model'),
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
        if (!is_dir($folder)) return false;

        $objects = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($folder),
            RecursiveIteratorIterator::SELF_FIRST);

        foreach($objects as $name => $object)
        {
            if ($object->isFile())
            {
                $source = file_get_contents($object->getPathname());
                preg_match("/namespace (.*);/", $source, $namespace);
                preg_match("/class (.*) extends (.*)\\s*/", $source, $class);

                if (!isset($class[1])) continue;

                if (empty($namespace)) {
                    $this->files[trim(str_replace(array('\\','{'),'',$class[2]))][str_replace('Model_','',$class[1])] = "\\".$class[1];
                } else {
                    $this->files[trim(str_replace(array('\\','{'),'',$class[2]))][str_replace('\Model','',$namespace[1])."\\".$class[1]] = "\\".$namespace[1]."\\".$class[1];
                }
            }
        }
    }

    protected function writeFile()
    {
        $file = realpath(APPPATH.'..'.DIRECTORY_SEPARATOR.'..').DIRECTORY_SEPARATOR.'.phpstorm.meta.php';

        $html = Twig::get_template_content('helpers/phpstorm_meta.twig',array(
            'files'=>$this->files,
        ));

        file_put_contents($file,$html);
    }
}