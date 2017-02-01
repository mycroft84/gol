<?php
/**
 * User: Tibor
 * Date: 2015.09.05.
 * Time: 10:04
 * Project: enigma
 * Company: d2c
 */
class Task_Orm_Translate_Init extends Minion_Task
{
    protected $_options = array();
    
    private $_translate_orms = array();
    private $_model_files = array();    

    public function build_validation(Validation $validation)
    {
        return parent::build_validation($validation);
    }

    protected function _execute(array $params)
    {
        ob_end_flush();
        $this->listDirs();
        $this->convertFilesToClass();
        $this->searchTranslatedOrm();

        $this->initTranslateOrms();
        ob_start();
    }
    
    public function listDirs()
    {
        $path = array_merge(array(APPPATH),array_values(Kohana::modules()));
        foreach ($path as $dir) {
            $dir.= 'classes'.DIRECTORY_SEPARATOR.'Model';
            if (is_dir($dir)) {
                $this->_model_files =  array_merge($this->_model_files,$this->getFiles($dir));
            }
        }

        echo "\n".count($this->_model_files)." model files found\n";
    }

    private function getFiles($dir)
    {
        $files = array();
        $objects = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($dir),
            RecursiveIteratorIterator::SELF_FIRST
        );

        foreach($objects as $object){
            if ($object->isFile()) {
                $files[] = $object->getPathname();
            }
        }

        return $files;
    }

    private function convertFilesToClass()
    {
        foreach ($this->_model_files as &$item) {
            $file = substr($item,strpos($item,'classes\Model\\') + strlen('classes\Model\\'),-4);

            $item = 'Model_'.str_replace(DIRECTORY_SEPARATOR,'_',$file);
        }
    }

    private function searchTranslatedOrm()
    {
        foreach ($this->_model_files as $item) {
            try {
                $ref = new ReflectionClass($item);
                $hasTraslatefields = $ref->hasProperty('_translate_fields');

                if ($hasTraslatefields) {
                    $translateFields = $ref->getProperty('_translate_fields');
                    $translateFields->setAccessible(true);
                    $fields = $translateFields->getValue(new $item);

                    if (!empty($fields)) {
                        if (!in_array($item,$this->_translate_orms))
                            $this->_translate_orms[] = $item;
                    }

                }
            } catch (Exception $e) {
                //echo Debug::vars($e->getMessage());
            }
        }

        echo count($this->_translate_orms)." translate model found\n";
    }

    private function initTranslateOrms()
    {

        foreach ($this->_translate_orms as $item) {
            echo "--------------------------------------------------------\n";
            echo $item." has started\n";

            $orm = new $item;

            echo 'Create languages table for '. $item."\n";
            $orm->createLanguagesTable();

            echo 'Create view for '. $item."\n";
            $orm->createTranslateView(true);

            echo 'Create view orm for '. $item."\n";
            $orm->createTranslateOrm();
        }

    }
}