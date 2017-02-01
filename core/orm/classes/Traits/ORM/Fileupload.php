<?php
/**
 * User: Tibor
 * Date: 2015.08.24.
 * Time: 19:09
 * Project: enigma
 * Company: d2c
 */
trait Traits_ORM_Fileupload
{
    protected $uploadSettings = array();
    protected $files = array();

    /**
     * @return Containers_File
     */
    public function getFiles()
    {
        if ($this->files == null) {
            $files = ORM::factory('files');
            $this->files = $files->getFilesForTable($this->_table_name,$this->pk());
        }

        return $this->files;
    }

    protected function getBase64File($data,$name,$type,$details='',$types = array(),$alreadyEncode = true)
    {
	    $result['userFiles'][] = array(
            'name'=>$name,
            'original_name'=>$name,
            'type'=>$type,
            'size'=>strlen($data),
            'details'=>$details,
            'types'=>$types,
            'data'=>($alreadyEncode) ? $data : base64_encode($data),
            'inputName'=>'file',
            'base64'=>true,
        );

	    return $result;
    }
    
    protected function checkFileAlreadyUploaded($content)
    {
        return ORM::factory('Files',array(
            'fi_table'=>$this->table_name(),
            'fi_ref_id'=>$this->pk(),
            'fi_hash'=>sha1($content)
        ));
    }
    
    protected function fileUpload($data)
    {
        if (!empty($data['userFiles'])) {
			
			if (empty($this->uploadSettings)) {
		        $formName = (!empty($this->form)) ? $this->form : $this->_table_name;
                $form = Formbuilder::factory($formName,$this,true);

		        $this->uploadSettings = $form->getFileUploadSettings();
	        }

            $data['form'] = $this->_table_name;
            $data['id'] = $this->pk();

            $files = new Model_Files();

            $removeFiles = array();
            $customInputs = $this->getCustomInputs($data['userFiles']);

            if ($this->hasOnlyOneFile() and !empty($customInputs)) {
                $removeFiles = $files->delTableItem($this->_table_name,$this->pk(),$customInputs);
            }

            $add = $files->saveAllFiles($data);
            if ($this->hasOriginalDel() and !empty($customInputs)) {
                $removeFiles = $files->delOriginalItem($this->_table_name,$this->pk(),$customInputs);
            }


            return  array(
                'add'=>$add,
                'remove'=>$removeFiles
            );
        }
    }

    private function hasOnlyOneFile()
    {
        if ($this->uploadSettings['onlyOne']) return true;

        if (array_key_exists('inputs',$this->uploadSettings)) {
            foreach($this->uploadSettings['inputs'] as $item) {
                if ($item['onlyOne']) return true;
             }
        }

        return false;
    }

    private function hasOriginalDel()
    {
        if ($this->uploadSettings['originalDel']) return true;

        return false;
    }

    private function getCustomInputs($userFiles)
    {
        $result = array();

        if (array_key_exists('inputs',$this->uploadSettings)) {
            foreach($this->uploadSettings['inputs'] as $name=>$item) {
                if ($item['onlyOne'] and array_key_exists($name,$userFiles)) {
                    $result[] = $name;
                }
            }
        }

        return $result;
    }

    private function fileUploadValidation($data)
    {
        $formName = (!empty($this->form)) ? $this->form : $this->_table_name;

        $form = Formbuilder::factory($formName,$this,true);
        $this->uploadSettings = $uploadSettings = $form->getFileUploadSettings();

        $validation = Validation::factory($data['userFiles']);

        foreach($data['userFiles'] as $index=>$file)
        {
            $settings = (!array_key_exists('inputs',$uploadSettings)) ? $uploadSettings : $uploadSettings['inputs'][$index];

            if ($settings['onlyPic']) {
                if (!empty($settings['maxResolution']) and count($settings['maxResolution']) == 2) {
                    $validation->rule($index,'Upload::image',array(':value',$settings['maxResolution'][0],$settings['maxResolution'][1]));
                } else {
                    $validation->rule($index,'Upload::image');
                }
            }

            if ($settings['maxSize']) $validation->rule($index,'Upload::size',array(':value',$settings['maxSize']));
            if (!empty($settings['allowTypes'])) $validation->rule($index,'Upload::type',array(':value',$settings['allowTypes']));

        }

        if (!$validation->check()) {

            return array(
                'error'=>true,
                'type'=>'upload',
                'messages'=>$validation->errors($this->_validation_dir),
                'lang'=>array(
                    'lang'=>current(Kohana::$config->load('settings.frontendLangs')),
                    'tab'=>0
                )
            );

        }

        return array('error'=>false);
    }
    
    public function clearFiles()
    {
        foreach ($this->getFiles()->getAll() as $block)
        {
            foreach ($block as $item) {
                ORM::factory('Files')->delFile($item);
            }
        }
    }


}