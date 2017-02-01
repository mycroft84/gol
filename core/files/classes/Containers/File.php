<?php
/**
 * User: Tibor
 * Date: 2014.02.09.
 * Time: 17:13
 * Project: d2cadmin3.3
 * Company: d2c
 */
class Containers_File extends Containers
{
    private $hasFile;

    private $firstPic;
    private $firstDoc;

    private $picsNum;
    private $docsNum;

    private $pics = array();
    private $docs = array();
    private $all = array();

    //for Formbuilder
    private $filesTypes;

    //for user
    private $types;

    /**
     * @param mixed $types
     */
    public function setTypes($types)
    {
        $this->types = $types;
    }

    /**
     * @return mixed
     */
    public function getTypesContainer()
    {
        return $this->types;
    }



    /**
     * @param mixed $filesTypes
     */
    public function setFilesTypes($filesTypes)
    {
        $this->filesTypes = $filesTypes;
    }

    /**
     * @return mixed
     */
    public function getFilesTypes()
    {
        return $this->filesTypes;
    }
    
    public function getFilesTypesAsArray()
    {
        $result = array();
        foreach ($this->filesTypes as $item) {
            $result[] = $item->as_array();
        }

        return $result;
    }

    /**
     * @param mixed $hasFile
     */
    public function setHasFile($hasFile)
    {
        $this->hasFile = $hasFile;
    }

    /**
     * @return mixed
     */
    public function getHasFile()
    {
        return $this->hasFile;
    }

    /**
     * @param mixed $docs
     */
    public function setDocs(Model_Files $files)
    {
        $this->docs[] = $files;
    }

    /**
     * @return mixed
     */
    public function getDocs()
    {
        return $this->docs;
    }

    /**
     * @param mixed $docsNum
     */
    public function setDocsNum($docsNum)
    {
        $this->docsNum = $docsNum;
    }

    /**
     * @return mixed
     */
    public function getDocsNum()
    {
        return $this->docsNum;
    }

    /**
     * @param mixed $firstDoc
     */
    public function setFirstDoc(Model_Files $firstDoc)
    {
        $this->firstDoc = $firstDoc;
    }

    /**
     * @return mixed
     */
    public function getFirstDoc()
    {
        return $this->firstDoc;
    }

    /**
     * @param mixed $firstPic
     */
    public function setFirstPic(Model_Files $firstPic)
    {
        $this->firstPic = $firstPic;
    }

    /**
     * @return mixed
     */
    public function getFirstPic()
    {
        return $this->firstPic;
    }

    /**
     * @param mixed $pics
     */
    public function setPics(Model_Files $files)
    {
        $this->pics[] = $files;
    }

    /**
     * @return mixed
     */
    public function getPics()
    {
        return $this->pics;
    }

    /**
     * @param mixed $picsNum
     */
    public function setPicsNum($picsNum)
    {
        $this->picsNum = $picsNum;
    }

    /**
     * @return mixed
     */
    public function getPicsNum()
    {
        return $this->picsNum;
    }

    public function getDefaultPic()
    {
        return $this->getPicTypeOrFirst('default');
    }

    public function getPicByType($type)
    {
        return $this->getPicTypeOrFirst($type);
    }
	
	public function getByType($type)
    {
        $type = $this->types->getFirst($type);
        if ($type->loaded()) {
            return $type;
        } else {
            return Orm::factory('Files');
        }
    }
	
	public function getByTypeAll($type_tag)
    {
        return $this->types->getTypes($type_tag);
    }

    public function getPicTypeOrFirst($type_tag)
    {
        $type = $this->types->getFirst($type_tag);
        if ($type->loaded()) {
            return $type;
        } else {
            return $this->getFirstPic();
        }
    }

    /**
     * @param mixed $all
     */
    public function setAll(Model_Files $all)
    {
        $index = preg_replace("/_\d*$/",'',$all->fi_input_name);

        if (!array_key_exists($index,$this->all)) {
            $this->all[$index] = array();
        }

        $this->all[$index][] = $all;
    }

    public function getByName($name)
    {
        return (isset($this->all[$name])) ? $this->all[$name] : new Model_Files();
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->all;
    }


}