<?php
/**
 * User: Tibor
 * Date: 2013.07.15.
 * Time: 21:02
 * Project: d2cadmin3.3
 * Company: d2c
 */
class Task_Assets_Userfiles_Clear_Files extends Minion_Task
{
    protected $_options = array(
    );

    private $deletedFiles = array();
    private $hasFiles = array();

    public function build_validation(Validation $validation) {
        return parent::build_validation($validation);
    }

    protected function _execute(array $params)
    {
        ob_end_flush();

        $this->hasFiles = $this->getFiles();

        $userfiles = Kohana::$config->load('settings.userfilesRealPath');

        $objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($userfiles), RecursiveIteratorIterator::SELF_FIRST);
        foreach($objects as $name => $object){
            if ($object->isFile() and !in_array($object->getExtension(),array('php','log','pem'))) {
                if (strpos($object->getFilename(),'_thum_') === false)
                {
                    if (!in_array($object->getFilename(),$this->hasFiles))
                    {
                        $this->deletedFiles[] = $object->getPathname();
                        //unlink($object->getPathname());
                    }
                } else {
                    $name = substr($object->getFilename(),0,strpos($object->getFilename(),'_thum_')).'.'.$object->getExtension();
                    if (!in_array($name,$this->hasFiles))
                    {
                        $this->deletedFiles[] = $object->getPathname();
                        //unlink($object->getPathname());
                    }
                }
            }
        }

        $this->removeFiles();
        ob_start();
    }

    protected function getFiles()
    {
        $files = DB::select()
            ->from('files')
            ->execute()
            ->as_array();

        $result = array();
        foreach ($files as $item) {
            $result[] = substr($item['fi_url'],4);
        }

        return $result;
    }

    protected function removeFiles()
    {
        foreach ($this->deletedFiles as $item) {
            //unlink($item);
            echo "DELETED: ".$item."\n";
        }

    }

}