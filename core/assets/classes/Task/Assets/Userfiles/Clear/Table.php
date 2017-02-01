<?php
/**
 * User: Tibor
 * Date: 2013.07.15.
 * Time: 21:02
 * Project: d2cadmin3.3
 * Company: d2c
 */
class Task_Assets_Userfiles_Clear_Table extends Minion_Task
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

        foreach ($this->hasFiles as $item) {
            $realpath = $userfiles.str_replace('/',DIRECTORY_SEPARATOR,$item['fi_url']);

            if (!is_file($realpath)) {
                $this->deletedFiles[] = $item['fi_id'];
                echo 'ADD DELETED ROW: '.$item['fi_id'].' - '.$realpath."\n";
            }
        }

        //$this->removeFiles();
        ob_start();
    }

    protected function getFiles()
    {
        $files = DB::select()
            ->from('files')
            ->execute()
            ->as_array();

        return $files;
    }

    protected function removeFiles()
    {
        if (!empty($this->deletedFiles)) {
            echo "DELETED ROW START\n";

            DB::delete('files')
                ->where('fi_id','IN',$this->deletedFiles)
                ->execute();

            echo 'DELETED ROW END';
        }
    }

}