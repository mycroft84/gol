<?php

class Kohana_Formbuilder
{
    public $hasLang = true;
    public $hasTab = true;
    public $hideTabHeader = false;
    public $tabs = array();
    protected $sections = array();

    public $langs = false;
    public $columnNum = 1;
    public $table = false;
    public $elements = false;
    public $root = false;
    public $helper = array();

    protected $columns = array();
    protected $values = array();
    protected $rules = array();
    protected $orm = false;

    protected $fileUpload = array();
    
    public $orm_loaded = false;

    protected $class = false;
    protected $has_captcha = false;
    protected $allArray = false;
	
	protected $hasTranslateField = false;

    protected $subForms = array();

    static function factory($name,ORM $orm = null, $onlyForValidation = false)
    {
        $class = self::getClassName($name);
        $object = new $class; 
        $object->class = $class;
        $object->elements = new Formelements;

        if ($orm) {
            $object->orm = $orm;
            $object->orm_loaded = $orm->loaded();
            if (!$onlyForValidation) $object->bindORM();
            $object->table = $orm->table_name();

            $object->columns = $object->orm->list_columns();
            $object->rules = array_merge($object->orm->get_scenario_rules(),$object->orm->get_scenario_rules($object->orm->get_scenario(),true),$object->rules());
            $object->fileUploadSettings();
            //if (!$onlyForValidation) $object->addDefaultVariables();
        } else {
            $object->rules = $object->rules();
			$object->fileUploadSettings();
            //if (!$onlyForValidation) $object->addDefaultVariables();
        }

        $object->build($object->elements);

        if ($orm) {
            $has_many = $orm->has_many();
            if (!empty($has_many)) $object->addHasManyRelations();
        }

        $object->langs = Kohana::$config->load('settings.frontendLangs');
        $object->root = URL::base(null,true);

		return $object;
    }
	
    protected static function getClassName($name)
    {
        $class = 'Form_';
        $parts = explode('_',$name);
        $name = array();
        foreach($parts as $item)
        {
            $name[] = ucfirst($item);
        }

        return $class.join('_',$name);
    }
    
    public function build(Formelements $elements) {}

    public function fileUpload() {}

    public function rules() { return array(); }

    protected function setSections() { return array(); }

    protected function fileUploadSettings()
    {
        $default = array(
            'fileUpload'=>false,
            'multiple'=>false,
            'onlyPic'=>false,
            'maxResolution'=>array(),
            'maxSize'=>false,
            'allowTypes'=>array(),
            'onlyOne'=>false,
            'enableDel'=>false,
            'originalDel'=>false
        );

        $upload = (is_array($this->fileUpload())) ? $this->fileUpload() : array();

        $temp = array_merge($default,$upload);

        if (array_key_exists('inputs',$temp)) {
            foreach($temp['inputs'] as $index => $item)
            {
                $temp['inputs'][$index] = array_merge($default,$item);
            }
        }

        $this->fileUpload = $temp;
    }

    public function getFileUploadSettings()
    {
        return $this->fileUpload;
    }

    protected function related_option_sort() { return array(); }

    protected function related_option_filter() {

        if ($this->orm->isIsNestedTree()) {
            return array(
                'nestedParent'=>array(
                    array(
                        'column'=>$this->orm->primary_key(),
                        'rel'=>'!=',
                        'value'=>$this->orm->pk()
                    )
                )
            );
        }

        return array();
    }

    public function getSubFormConfig() { return array(); }

    protected function addCustomDefaultFields() {}

    protected function addHasManyRelations()
    {
        foreach($this->orm->has_many() as $index=>$item)
        {
            if (!empty($item['through']))
            {
                $settings = $this->getManySettings($index);
                if (isset($settings['render']) and !$settings['render']) continue;



                $values = $this->getManyValues($item,$index);
                if (isset($settings['render']) and $settings['render'] == false) {
                    $settings['options'] = array();
                }

                $options = (!isset($settings['options'])) ? $this->getManyOptions($item,$index,(isset($settings['data-autocomplete']) and $settings['data-autocomplete'] == true),$values) : $settings['options'];

                $routename = strtolower($item['model'])."Create";

               $defaultSettings = array(
                   'multiple'=>'multiple',
                   'options'=>$options,
                   'value'=>$values
               );

               if (Route::hasRoute($routename)) {
                   $defaultSettings['addNew'] = false;
                   $defaultSettings['newUrl'] = Route::url($routename)."?iframe=1&select=".$index;
               } else {
                   $defaultSettings['addNew'] = false;
               }

               $this->elements->add('left',$index."[]",'select',array_merge($defaultSettings,$settings));
            }
        }
    }

    protected function getManySettings($name)
    {
        $options = array();

        foreach($this->elements->left as $index=>$item)
        {
            if ($item['name'] == $name) {
                $options = $item['options'];
                unset($this->elements->left[$index]);
            }
        }

        if (isset($this->elements->rigth))
        {
            foreach($this->elements->rigth as $index=>$item)
            {
                if ($item['name'] == $name) {
                    $options = $item['options'];
                    unset($this->elements->rigth[$index]);
                }
            }
        }

        return $options;
	}

    protected function getManyOptions($rel,$relname,$is_autocomplate = false,$ids = array())
    {
        $options = $this->listRelatedRecords($rel['model'],$relname,false,array(),$is_autocomplate,$ids);
        return $options;
    }

    protected function getManyValues($rel,$relname)
    {
        $model = ORM::factory($rel['model']);
        $pri = $model->primary_key();

        $valuesTemp = $this->orm->$relname->find_all();
        $values = array();
        foreach($valuesTemp as $item)
        {
            $values[] = $item->$pri;
        }

        return $values;
    }

    protected function addDefaultVariables()
    {
        $position = end($this->elements->left);
        $position = (!isset($position['options']['position'])) ? count($this->elements->left) + 1 : $position['options']['position'] + 1;

        //$this->elements->add('left','csrf_token','input',array('type'=>'hidden','value'=>Security::token(true),'position'=>$position));
        $prefix = substr($this->table,0,2);
        if ($this->fileUpload['fileUpload']) {

            if (!isset($this->fileUpload['inputs'])) {
                $this->addFileElement($this->fileUpload,$prefix.'_file');
            } else {
                foreach ($this->fileUpload['inputs'] as $key=>$item)
                {
                    $this->addFileElement($item,$key);
                }

            }
        }
        if ($this->has_captcha) {
            $captcha = Captcha::instance();

            $position = end($this->elements->left);
            $position = (!isset($position['options']['position'])) ? count($this->elements->left) + 1 : $position['options']['position'] + 1;

            $this->elements->add('left',$prefix."_captcha",'captcha',array('value'=>$captcha->render(),'position'=>$position,'placeholder'=>'Ellenőrző kód'));
        }

        if ($this->orm and $this->orm->isIsNestedTree()) {
            $this->elements->add('left','nestedParent','select',array('options'=>$this->getNestedParentElement(),'position'=>1));
        }

        $this->addCustomDefaultFields();
        //echo Debug::vars($this->rules);
    }

    protected function getNestedParentElement()
    {
        $elements = $this->listRelatedRecords(str_replace('Model_','',get_class($this->orm)),'nestedParent');

        return $elements;
    }

    protected function addFileElement($settings,$fileName)
    {
        $position = end($this->elements->left);
        $position = (!isset($position['options']['position'])) ? count($this->elements->left) + 1000 : $position['options']['position'] + 1000;

        $attr = array(
            'type'=>'file',
            'position' => $position
        );

        if ($settings['multiple']) {
            $attr['multiple'] = 'multiple';
            $fileName.="[]";
        }

        $this->elements->add('right',$fileName,'input',$attr);
        $this->columns[$fileName] = array(
            'column_name' => $fileName,
            'data_type' => 'varchar',
            'character_maximum_length'=>255,
            'key'=>'',
            'ordinal_position'=> $position
        );
    }

    public function bind(array $post)
    {
        $this->values = $post;
    }

    public function getFiles()
    {
        return ($this->orm) ? $this->orm->getFiles() : array();
    }

    protected function bindORM()
    {
        $this->bind($this->orm->getObjectValues());
    }

    public function render()
    {
        $this->addDefaultVariables();

        $this->sortNotSetElement();
        usort($this->elements->left,array('self','sortOrder'));
        usort($this->elements->right,array('self','sortOrder'));
        //echo Debug::vars($this);

        $this->elements->all = $this->getAllElements();
        $this->tabs = (empty($this->tabs)) ? array('base'=>'base') : $this->tabs;
        $this->sections = $this->setSections();

        $this->subForms = $this->setSubForms();

        return $this;
    }
    
    protected function getNotSetElements()
    {
        $colunmNames = array_keys($this->columns);
        $alreadySet = array();

        foreach($this->elements as $index=>$element)
        {
            foreach($element as $cIndex=>$col)
            {
                $cCol = (isset($this->columns[$col['name']])) ? $this->columns[$col['name']] : $this->setCustomElements($col,$index);

                $el = self::convertElement($cCol,$col);
                $side = $this->elements->$index;
                $side[$cIndex] = $el;
                $this->elements->$index = $side;
                
                $alreadySet[] = $col['name'];
            }
        }
        
        return array_diff($colunmNames,$alreadySet);
    }

    protected function setCustomElements($col,$index)
    {
        $result = array(
            'column_name' => $col['name'],
            'data_type' => 'varchar',
            'character_maximum_length'=>255,
            'key'=>'',
            'ordinal_position'=>$index
        );


        if (isset($col['options']['type']) and $col['options']['type'] == 'checkbox') {
            unset($result['character_maximum_length']);
            $result['data_type'] = 'tinyint';
            $result['display'] = 1;
        }

        if ($col['type'] == 'textarea') {
            unset($result['character_maximum_length']);
            $result['data_type'] = 'text';
        }

        //echo Debug::vars($result);

        return $result;
    }
    
    protected function sortNotSetElement()
    {
        $notSet = self::getNotSetElements();

        foreach($notSet as $item)
        {
            $colInfo = $this->columns[$item];
            if ($colInfo['key'] != 'PRI' or ($colInfo['key'] == 'PRI' and $this->values[$item]))
            {
                $el = self::convertElement($colInfo);
                self::addSide($el);
            }
        }
    }
    
    protected function convertElement($col,array $o = array())
    {
        $type = 'input';

        $search = array('[',']');
        $replace = array('','');
        $name = str_replace($search,$replace,$col['column_name']);
		$langs = Kohana::$config->load('settings.frontendLangs');

        $rules = (isset($this->rules[$name])) ? Arr::DBQueryConvertSingleArray($this->rules[$name]) : array();
        $translateFields = ($this->orm) ? $this->orm->getTranslateFields() : array();

		if (!empty($translateFields) and count($langs) > 1) {
            $this->hasTranslateField = true;
        }
		
        $options = array(
            'message'=>(isset($this->helper[$col['column_name']])) ? $this->helper[$col['column_name']] : false,
            'translate'=>(in_array($col['column_name'],$translateFields) and count($langs) > 1),
            'render'=>true,
            'required'=>(in_array('not_empty',$rules) || in_array('not_empty_select',$rules)) ? true : false,
            'isArray'=>$this->allArray,
        );

		if (!empty($o))
        {
            if (isset($o['type']) and $o['type']) $type = $o['type'];
            if (isset($o['options']) and is_array($o['options'])) $options = array_merge($options,$o['options']);
        }

        if (array_key_exists($name,$this->values)) {
            $options['value'] = $this->values[$name];
        }

        if ($col['data_type'] == 'text' || $col['data_type'] == 'longtext')
        {
            $type = 'textarea';
            $options = array_merge($options,array('class'=>'HtmlDescription'));
        }

        if (($col['data_type'] == 'varchar' and $col['character_maximum_length'] == 25) || $col['data_type'] == 'date')
        {
            $options = array_merge($options,array('date'=>true));
        }
        
        if (($col['data_type'] == 'tinyint' and $col['display'] == 1) || ($col['data_type'] == 'int' and $col['display'] == 1))
        {
            $options = array_merge($options,array('type'=>'checkbox','class'=>'iphoneStyle'));
        }

        if ($col['key'] != 'PRI' and (($col['data_type'] == 'int' and $col['display'] == 11) || ($col['data_type'] == 'bigint' and $col['display'] == 20) || ($col['data_type'] == 'int unsigned' and $col['display'] == 11))) {

            $relation = $this->getRelation($col['column_name']);
            if (!empty($relation) and (!isset($o['type']) or $o['type'] == 'select')) {
                $type = 'select';
                 
				if (isset($o['options'])) {
                    if (isset($o['options']['render']) and $o['options']['render'] == false) {
                        $option = array();
                    } elseif (isset($o['options']['data-autocomplete'])) {
                        $option = $this->listRelatedRecords($relation['rel']['model'],$relation['relname'],$relation['rel']['foreign_key'],$options,false,array($this->orm->$col['column_name']));
                    } elseif (isset($o['options']['options'])) {
                        $option = $o['options']['options'];
                    }
                } else {
                    $option = $this->getOptionsValues($relation,(isset($o['options']['options'])) ? $o['options']['options'] : array());
                }
                $select_options = array(
                   'options'=>$option
               );

                if (is_null($options['value'])) $options['value'] = -1;

               $routeName = strtolower($relation['model'])."Create";
               if (Route::hasRoute($routeName)) {
                   $select_options['addNew'] = false;
                   $select_options['newUrl'] = Route::url($routeName)."?iframe=1&select=". $col['column_name'];
               } else {
                   $select_options['addNew'] = false;
               }

               $options = array_merge($options,$select_options);
            }
        }

        if ($col['key'] == 'PRI')
        {
            $type = 'input';
            $options = array_merge($options,array('type'=>'hidden'));
        }
        
        $options['position'] = $col['ordinal_position'] * 10;

        if (in_array($name,$this->helper)) {
            $options['helper'] = 1;
        }

        if (!empty($o))
        {
            if (isset($o['type']) and $o['type']) $type = $o['type'];
            if (isset($o['options']) and is_array($o['options'])) $options = array_merge($options,$o['options']);
        }


        return array(
            'name'=>$col['column_name'],
            'type'=>$type,
            'options'=>$options  
        );     
    }
    
    protected function addSide($data)
    {
        $side = ($data['type'] == 'textarea') ? 'right' : 'left';
        
        $this->elements->add($side,$data['name'],$data['type'],$data['options']);
    }
    
    protected static function sortOrder($a,$b)
    {
        if ($a['options']['position'] == $b['options']['position']) {
            return 0;
        }
        return ($a['options']['position'] < $b['options']['position']) ? -1 : 1;
    }

    protected function getOptionsValues($relation,$options)
    {
        if ($relation) {

            return $this->listRelatedRecords($relation['rel']['model'],$relation['relname'],$relation['rel']['foreign_key'],$options);
        } else throw new Exception('Relation not defined to "'.$relation['rel']['foreign_key'].'"');
    }

    protected function listRelatedRecords($model,$relname,$foreign_key = false, $options = array(),$is_autocomplete = false,$ids = array())
    {
        //$modelName = 'Model_'.$model;
        //$model = new $modelName;
        $model = ORM::factory($model);

        $names = $model->getNamesFields();
        //echo Debug::vars($names);
        $relation = false;

        if (is_array($names) and array_key_exists('relation',$names)) {
            $relation = $names['relation'];
            $names = $names['names'];
        }

        $related_sort = $this->related_option_sort();
        $related_filter = $this->related_option_filter();

        if (array_key_exists($relname,$related_filter))
        {
            foreach($related_filter[$relname] as $item)
            {
                $model->where($item['column'],$item['rel'],$item['value']);
            }
        }

        if (isset($options['data-autocomplete']) and $options['data-autocomplete']) {
            $model->where($model->primary_key(),'=',$this->orm->$foreign_key);
        }

        if ($is_autocomplete) {
            if (empty($ids)) $ids[] = -1;
            $model->where($model->primary_key(),'IN',$ids);
        }

        if (array_key_exists($relname,$related_sort))
        {
            $model->order_by($related_sort[$relname]['field'],$related_sort[$relname]['order']);
        }

        $records = array();
        foreach ($model->find_all() as $item)
        {
            $temp = array();
            foreach ($names as $name)
            {
                if ($relation) {
                    $temp[] = $item->$relation->$name;
                } else {
                    $temp[] = $item->$name;
                }
            }

            $temp = array(
                'value'=>$item->pk(),
                'name'=>join(' ',$temp)
            );

            if (isset($options['optionDatas']) and is_array($options['optionDatas'])) {
                $temp['data'] = array();
                foreach ($options['optionDatas'] as $index=>$data) {
                    $temp['data'][$index] = $item->$data;
                }

            }

            $records[] = $temp;
        }

        return $records;
    }

    protected function getRelation($column)
    {
        $belongs = $this->orm->belongs_to();
        foreach($belongs as $index=>$item)
        {
            if ($item['foreign_key'] == $column) {
                return array(
                    'rel'=>$item,
                    'relname'=>$index,
                    'model'=>$item['model']
                );
            }
        }

    }

    public function validation($post)
    {
        $validation = Validation::factory($post);
        foreach($post as $index=>$item)
        {
            if (array_key_exists($index,$this->rules)) {
                $validation->rules($index,$this->rules[$index]);
            }
        }

        if ($validation->check()) {
            return array('error'=>false);
        } else {
            return array('error'=>true,'messages'=>$validation->errors('validate'));
        }
    }

    public function getRules()
    {
        return $this->rules;
    }

    protected function getAllElements()
    {
        $result = array();
        foreach($this->elements as $sides)
        {
            foreach($sides as $el)
            {
                $result[str_replace(array('[]'),array(''),$el['name'])] = $el;
            }
        }

        return $result;
    }
	
	function __get($name)
    {
        return $this->elements->all[$name];
    }

    public function __isset($name)
    {
        return isset($this->elements->all[$name]);
    }

    /**
     * @return boolean
     */
    public function getHasCaptcha()
    {
        return $this->has_captcha;
    }

    protected function setSubForms()
    {
        $result = array();

        $settings = $this->getSubFormConfig();
        if ($this->orm) {
            $has_many = $this->orm->has_many();
            foreach ($settings as $setting) {
                if (array_key_exists($setting['relation'],$has_many)) {
                    $temp = $setting;

                    $temp['form'] = $this->getSubformValues($setting['form'],$setting['relation']);
                    $temp['formTemplate'] = $this->getSubformHelpers($setting['form'],$has_many[$setting['relation']]);
                    if (!isset($setting['tab'])) $temp['tab'] = 'base';

                    $result[] = $temp;
                }
            }
        } else {
            foreach ($settings as $setting) {
                $temp = $setting;
                $temp['formTemplate'] = $this->getSubformHelpers($setting['form']);
                if (!isset($setting['tab'])) $temp['tab'] = 'base';

                $result[] = $temp;
            }
        }


        return $result;
    }

    protected function getSubformHelpers($helperForm, $has_many = null)
    {
        $orm = ($has_many) ? ORM::factory($has_many['model']) : null;
        $form = Formbuilder::factory($helperForm,$orm);
        return $form->render();
    }

    protected function getSubformValues($formName, $relation)
    {
        $result = array();
        foreach ($this->orm->$relation->find_all() as $item) {
            $form = Formbuilder::factory($formName,$item);
            $result[] = $form->render();
        }

        return $result;
    }

    /**
     * @return array
     */
    public function getSubForms()
    {
        return $this->subForms;
    }

    /**
     * @return array
     */
    public function getSections()
    {
        return $this->sections;
    }

    public function getElementsForTab($tab, $index,$lang)
    {
        $sectionData = (isset($this->sections[$tab])) ? $this->sections[$tab] : array();
        $section = (isset($sectionData[$index])) ? $sectionData[$index] : array();
        $fields = (isset($section['fields'])) ? $section['fields'] : array();

        $langs = Kohana::$config->load('settings.frontendLangs');
        $defaultLang = current($langs);

        $result = array();
        foreach($fields as $block)
        {
            $temp = array();
            foreach($block as $field) {

                $item = $this->elements->all[$field];

                if ($item['options']['render'] == true) {
                    if (!isset($item['options']['type']) or $item['options']['type'] != 'hidden') {
                        if (in_array($lang, $langs)) {
                            //hasLang tabs
                            if ($defaultLang == $lang) {
                                $temp[] = $item;
                            } else {
                                if ($item['options']['translate']) {
                                    $temp[] = $item;
                                }
                            }
                        } else {
                            if (isset($item['options']['tab']) == false || $item['options']['tab'] == $lang) {
                                $temp[] = $item;
                            }
                        }
                    }
                }
            }

            $result[] = $temp;
        }

        //echo Debug::vars($result);
        //exit;

        return $result;
    }
    
    public function hasTranslateField()
    {
        return $this->hasTranslateField;
    }

}