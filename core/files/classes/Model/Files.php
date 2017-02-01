<?php

class Model_Files extends ORM
{

    protected $_table_name = 'files';
    protected $_primary_key = 'fi_id';

    protected $orderField = 'fi_order';
    protected $orderDependencies = array('fi_table','fi_ref_id');

    protected $_belongs_to = array(
        'created_by'=>array(
            'model'=>'User',
            'foreign_key'=>'fi_user'
        )
    );

    protected $_has_many = array(
        'types'=>array(
            'model'=>'Files_Types',
            'through'=>'file_types_to_file',
            'foreign_key'=>'ft_id',
            'far_key'=>'fi_id'
        )
    );

    public function saveAllFiles($data)
    {
        $files = array();
        foreach($data['userFiles'] as $index=>$item)
        {
            if (isset($item['error']) and $item['error'] ==  0)
            {
                $this->saveFile($item,$data['form'],$data['id'],$index);

                $postfix = isset($data['postfix']) ? current(explode('_',$index)) : "";
                if (strpos($item['type'],'image') !== false) {
                    $this->createThumb($postfix);
                    $this->fixOrientation();
                }

            } else {

                if (isset($item['base64']) and $item['base64'])
                {
                    $this->saveBase64File($item,$data['form'],$data['id']);

                    $postfix = isset($data['postfix']) ? current(explode('_',$index)) : "";
                    if (strpos($item['type'],'image') !== false) {
                        $this->createThumb($postfix);
                        $this->fixOrientation();
                    }
                }

            }
        }

        return $files;
    }

    public function saveFile($item,$table,$id,$input_name)
    {
        $fileExt = strtolower(File::getFileExt($item['name']));
        $newName = md5(sha1($item['name'].time()));
        $filename = $newName.".".$fileExt;
        $fileUrl = $newName[0]."/".$newName[1]."/";

        Storages::instance()->upload($item,$newName[0].DIRECTORY_SEPARATOR.$newName[1].DIRECTORY_SEPARATOR.$filename);

        $this->addFileRow($table,$id,$item['name'],$item['name'],$input_name,$fileUrl.$filename,$item['type'],$item['size']);

        Orientation::factory(Kohana::$config->load('settings.userfilesRealPath').DIRECTORY_SEPARATOR.$newName[0].DIRECTORY_SEPARATOR.$newName[1].DIRECTORY_SEPARATOR.$filename)->fix();

        return $this;
    }

    public function saveBase64File($item,$table,$id)
    {
        $fileExt = strtolower(File::getFileExt($item['name']));
        $newName = md5(sha1($item['name'].time()));
        $filename = $newName.".".$fileExt;
        $fileUrl = $newName[0]."/".$newName[1]."/";

        $store = Storages::instance()->createFile(base64_decode($item['data']),$newName[0].DIRECTORY_SEPARATOR.$newName[1].DIRECTORY_SEPARATOR.$filename);

        $this->addFileRow($table,$id,$item['name'],$item['original_name'],$item['inputName'],$fileUrl.$filename,$item['type'],$item['size'],$item['details'],$item['types']);

        Orientation::factory(Kohana::$config->load('settings.userfilesRealPath').DIRECTORY_SEPARATOR.$newName[0].DIRECTORY_SEPARATOR.$newName[1].DIRECTORY_SEPARATOR.$filename)->fix();

        return $this;
    }
	
    public function fixOrientation()
    {
        Orientation::factory(Kohana::$config->load('settings.userfilesRealPath').DIRECTORY_SEPARATOR.str_replace('/',DIRECTORY_SEPARATOR,$this->fi_url))->fix();
    }
    
	public function copyFile($table, $id)
    {
        $fileExt = strtolower(File::getFileExt($this->fi_name));
        $newName = md5(sha1($this->fi_name.time()));
        $filename = $newName.".".$fileExt;

        $dirname = Kohana::$config->load('settings.userfilesRealPath').DIRECTORY_SEPARATOR.$newName[0].DIRECTORY_SEPARATOR.$newName[1];
        $fileUrl = $newName[0]."/".$newName[1]."/";
        //file_put_contents($dirname.DIRECTORY_SEPARATOR.$filename,file_get_contents(Kohana::$config->load('settings.userfilesRealPath').DIRECTORY_SEPARATOR.str_replace('/',DIRECTORY_SEPARATOR,$this->fi_url)));
        Storages::instance()->copy(str_replace('/',DIRECTORY_SEPARATOR,$this->fi_url),$newName[0].DIRECTORY_SEPARATOR.$newName[1].DIRECTORY_SEPARATOR.$filename);

        $file = ORM::factory('Files')->addFileRow($table,$id,$this->fi_name,$this->fi_original_name,$this->fi_input_name,$fileUrl.$filename,$this->fi_type,$this->fi_size);

        return $file;
    }

    public function addFileRow($table,$ref_id,$name,$original_name,$input_name,$url,$type,$size,$desc = '',$types = array())
    {
        $this->clear();
        $this->fi_name = $name;
        $this->fi_original_name = $original_name;
        $this->fi_input_name = $input_name;
        $this->fi_url = $url;
        $this->fi_type = $type;
        $this->fi_size = $size;
        $this->fi_datetime = time();
        $this->fi_table = $table;
        $this->fi_ref_id = $ref_id;
        $this->fi_desc = $desc;
        
        $content = Storages::instance()->getFileContent($this->fi_url);
        $this->fi_hash = sha1($content);

        $this->save();

        if (!empty($types)) {
            foreach ($types as $item) {
                if ($item != -1) {
                    $this->add('types',$item);
                }
            }
        }

        return $this;
    }

    public function createThumb($postfix = "")
    {
		if (strpos($this->fi_type,'image') === false) return false;
		
        $dirname = Kohana::$config->load('settings.userfilesRealPath');
        $thumWidth = Kohana::$config->load('settings.'.$this->fi_table.$postfix.'PicWidth');
        $thumHeight = Kohana::$config->load('settings.'.$this->fi_table.$postfix.'PicHeight');
        $crops = Kohana::$config->load('settings.'.$this->fi_table.$postfix.'PicCrops');
        $watermark = Kohana::$config->load('settings.'.$this->fi_table.$postfix.'PicWatermark');
		
		if (!is_array($crops)) $crops = array();
        if (!is_array($watermark)) $watermark = array();

        $thumbs = array();
        if (is_array($thumWidth))
        {        
            foreach($thumWidth as $index=>$value)
            {
                $cCrops = (isset($crops[$value]) and isset($crops[$value][$thumHeight[$index]])) ? $crops[$value][$thumHeight[$index]] : array('type'=>Image::CROP);
                $cWatermark = (isset($watermark[$value]) and isset($watermark[$value][$thumHeight[$index]])) ? $watermark[$value][$thumHeight[$index]] : array();

                $file = Storages::instance()->getFileContent($this->fi_url);
                $currentfile = str_replace('/',DIRECTORY_SEPARATOR,$this->fi_url);
                $thumbs[] = Image::createThum(
                    $file,
                    $value,
                    $thumHeight[$index],
                    $currentfile,
                    "_".$value."x".$thumHeight[$index],
                    $cCrops,
                    $cWatermark
                );
            }
        }
        return $thumbs;
    }

	public function del($id)
    {
        $query = $this->where('fi_id','=',$id)->find();
        if ($query->loaded()) {
            return $this->delFile($this);
        }
    }
    
    public function delFile(Model_Files $file)
    {
        try {
            if (!$file->loaded()) return array('error' => false);

            $fPos = strrpos($file->fi_url,'/');
            $folder = substr($file->fi_url,0,$fPos);

            $filename = current(explode('.', substr($file->fi_url,$fPos + 1)));

            $files = Storages::instance()->listDirectory($folder);

            foreach ($files as $item) {
                if (strpos($item, $filename) !== false)
                    Storages::instance()->delete(substr($file->fi_url,0,$fPos + 1).$item);
            }

            $file->delete();

            return array('error' => false);
        } catch (Exception $e) {
            return array('error' => true);
        }
    }

    public function delTableItem($table, $ref_id = null,$inputs = array())
    {
        $this->clear();
        $files = $this->where('fi_table','=',$table);
        if ($ref_id) $files->where('fi_ref_id','=',$ref_id);

        if (!empty($inputs)) {
            $files->where_open();
            foreach($inputs as $item)
            {
                $files->or_where('fi_input_name','=',$item);
            }
            $files->where_close();
        }

        $files = $files->find_all();

        $delID = array();
        foreach($files as $item)
        {
            if ($item->loaded())
            {
                $this->delFile($item);
                $delID[] = $item->fi_id;
            }
        }

        return $delID;
    }

    public function delOriginalItem($table, $ref_id = null,$inputs = array())
    {
        $this->clear();
        $files = $this->where('fi_table','=',$table);
        if ($ref_id) $files->where('fi_ref_id','=',$ref_id);

        if (!empty($inputs)) {
            $files->where_open();
            foreach($inputs as $item)
            {
                $files->or_where('fi_input_name','=',$item);
            }
            $files->where_close();
        }
        $files = $files->find_all();

        foreach($files as $item)
        {
            if ($item->loaded())
            {
                Storages::instance()->delete(str_replace('/',DIRECTORY_SEPARATOR,$item->fi_url));
            }
        }
    }

    static function genUploadItem($data,$edit = true ,$del = true)
    {
        $html = "";
        foreach($data as $item)
        {
            $html.="<div id='".$item['fi_id']."' class='uploadFileItem'>
                        <span class='originalname'><a href='".URL::base(null,true)."download/files/".$item['fi_id']."'>".$item['fi_name']."</a></span>";
            if ($del) $html.= "<button class='delItem'>".Kohana::subtitles('buttonDelete')."</button>";
            if ($edit) $html.= "<button class='editItem'>".Kohana::subtitles('buttonEdit')."</button>";
            $html.="</div>";
        }
        
        return $html;
    }

    public function getFilesForTable($table,$id)
    {
        $container = new Containers_File();
        $fileType = ORM::factory('Files_Types')
            ->where('ft_table','IS',NULL)
            ->or_where('ft_table','=',$table)
            ->find_all();

        $container->setFilesTypes($fileType);
        $typeContainer = new Containers_File_Types($fileType);
        
        $files = $this
            ->where('fi_table','=',$table)
            ->where('fi_ref_id','=',$id)
            ->order_by('fi_order')
            ->find_all();

        foreach($files as $item)
        {
            if (!$container->getHasFile()) $container->setHasFile(true);

            $item->_object['filesize'] = File::fileSizeFormat(Storages::instance()->filesize($item->fi_url));

            if (strpos($item->fi_type,'image') !== false) {
                $item->_object['thumbs'] = $this->getThumsFileName($table,$item->fi_url);

                if (!$container->getFirstPic()) $container->setFirstPic($item);

                $container->setPics($item);
            } else {

                if (!$container->getFirstDoc()) $container->setFirstDoc($item);

                $container->setDocs($item);
            }

            $container->setAll($item);

            $typeContainer->setFileType($item);
        }

        $container->setTypes($typeContainer);

        if (!$container->getFirstPic()) {
            $file = new Model_Files();
            $file->_object['thumbs'] = new Containers_File_Thumbs();

            $container->setFirstPic($file);
        }

        $container->setPicsNum(count($container->getPics()));
        $container->setDocsNum(count($container->getDocs()));

        return $container;

    }

    public function getThumsFileName($table,$name)
    {
        $thumWidth = Kohana::$config->load('settings.'.$table.'PicWidth');
        $thumHeight = Kohana::$config->load('settings.'.$table.'PicHeight');
        $parts = explode('.',$name);

        $thumbs = new Containers_File_Thumbs();
        if (is_array($thumWidth)) {
            foreach($thumWidth as $index=>$value) {
                $thumbs->setThumb($value,$thumHeight[$index],$thumbs->getThumbFilename($name,$value,$thumHeight[$index]));
            }
        }

        return $thumbs;
    }

    public function setFileType($id,$types)
    {
        try{
            $this->clear();
            $file = $this->where('fi_id','=',$id)->find();

            foreach($file->types->find_all() as $item)
            {
                $file->remove('types',$item->ft_id);
            }

            if (is_array($types))
            {
                foreach($types as $item)
                {
                    if ($item == 1) {
                        $file->setDefault();
                    } else {
                        $file->add('types',$item);
                    }
                }
            }

            return array('error'=>false);

        } catch (Exception $e) {
            return array('error'=>true,'message'=>$e->getMessage());
        }
    }

    public function setInput($id, $name, $value)
    {
        try{
            $this->clear();
            $file = $this->where('fi_id','=',$id)->find();

            $file->$name = $value;
            $file->save();

            return array('error'=>false);

        } catch (Exception $e) {
            return array('error'=>true,'message'=>$e->getMessage());
        }
    }

    public function setOrder($ids)
    {
        if (is_array($ids)) {
            foreach ($ids as $index => $item) {
                DB::update('files')
                    ->set(array('fi_order'=>$index + 1))
                    ->where('fi_id','=',$item)
                    ->execute();
            }
        }

        return array('error'=>false);
    }

    public function setDefault()
    {
        $idsTemp = DB::select('fi_id')
            ->from('files')
            ->where('fi_table','=',$this->fi_table)
            ->where('fi_ref_id','=',$this->fi_ref_id)
            ->execute()->as_array();

        $ids = array();
        foreach ($idsTemp as $item) {
            $ids[] = $item['fi_id'];
        }

        DB::delete('file_types_to_file')
            ->where('ft_id','IN',$ids)
            ->where('fi_id','=',1)
            ->execute();

        $this->add('types',1);
    }

    public function getTypesAsArray()
    {
        $types = array();
        foreach($this->types->find_all() as $item)
        {
            $types[] = $item->ft_id;
        }

        return $types;
    }

    public function isType($type = 'default')
    {
        $query = $this->types->where('ft_tag','=',$type)->find();
        return $query->loaded();
    }

    public function getRealPath()
    {
        return Kohana::$config->load('settings.userfilesRealPath').DIRECTORY_SEPARATOR.str_replace('/',DIRECTORY_SEPARATOR,$this->fi_url);
    }

    public function getThumbs()
    {
        return $this->thumbs;
    }
}