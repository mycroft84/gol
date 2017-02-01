<?php
/**
 * User: Tibor
 * Date: 2015.08.24.
 * Time: 20:09
 * Project: enigma
 * Company: d2c
 */
trait Traits_ORM_Save
{
    public function bind($post)
    {
        $created_column = (is_array($this->_created_column)) ? $this->_created_column['column'] : null;
        $updated_column = (is_array($this->_updated_column)) ? $this->_updated_column['column'] : null;
        $created_by = (is_array($this->_created_by)) ? $this->_created_by['column'] : null;
        $updated_by = (is_array($this->_updated_by)) ? $this->_updated_by['column'] : null;

        foreach($this->_table_columns as $index=>$value)
        {
            if ($index != $created_column and $index != $updated_column and $index != $created_by and $index != $updated_by) {

                if (isset($post[$index])) {

                    if ($value['key'] == 'PRI') {
                        $this->_primary_key_value = $post[$index];
                    }

                    $this->$index = $post[$index];
                    $this->_changed[$index] = $index;
                } else $this->$index = NULL;
            }

        }

        return $this;
    }

    public function submit($data,$checkToken = false)
    {
        $formName = (!empty($this->form)) ? $this->form : $this->_table_name;
        $form = Formbuilder::factory($formName,$this,true);
        $subforms = $form->getSubFormConfig();

        if (empty($subforms)) {
            return $this->submitSimple($data,$form,$checkToken);
        } else {
            return $this->submitSubforms($data,$subforms,$checkToken);
        }
    }

    protected function submitSimple($data,$form = null,$checkToken = false)
    {
        try{
            if ($checkToken) $this->securityValidation($data);
            $this->checkCaptcha($data);

            $uploadValidation = $this->fileUploadValidation($data);
            if ($uploadValidation['error']) return $uploadValidation;

            if (isset($data[$this->_primary_key]) and !empty($data[$this->_primary_key])) $this->_loaded = true;

            $this->bind($data);
            $this->setLang('*');

            $reload = (!isset($data[$this->_primary_key]) or !empty($data['userFiles']));

            if ($this->is_nested_tree and isset($data['nestedParent']) and $data['nestedParent'] != -1) {
                $parent = clone $this;
                $parent->clear();
                $parent = $parent->where($parent->primary_key(),'=',$data['nestedParent'])->find();

                if ($this->loaded()) $this->move_as_first_child_of($parent);
                else $this->insert_as_first_child_of($parent);

            } else {
                $this->save();
            }


            $this->saveHasManyData($data);
            $this->setDefaultFieldValue();

            $uploadFiles = array('add'=>array(),'remove'=>array());
            if ($this->uploadSettings['fileUpload']) {
                $uploadFiles = $this->fileUpload($data);
            }

            return array('error'=>false,'id'=>$this->pk(),'name'=>$this->getElementName(),'reload'=>$reload,'files'=>$uploadFiles['add'],'remove'=>$uploadFiles['remove']);

        } catch (ORM_Validation_Exception $e) {
            $error = array(
                'error'=>true,
                'messages'=>$e->errors($this->_validation_dir),
                'lang'=>$e->getLang()
            );

            if ($form) {
                $error['hasLang'] = $form->hasLang;
            }

            return $error;
        }
    }

    protected function submitSubforms($data,$subforms,$checkToken = false)
    {
        $validation = $this->validationSubforms($data,$subforms);
        if ($validation['error']) return $validation;

        $parentSubmit = $this->submitSimple($data,$checkToken);
        if ($parentSubmit['error']) return $parentSubmit;

        $childrenSubmit = $this->saveSubforms($data,$subforms,$parentSubmit['id'],$checkToken);
        if ($childrenSubmit['error']) return $childrenSubmit;

        $parentSubmit['reload'] = true;
        return $parentSubmit;
    }

    private function saveSubforms($data,$subforms,$parent_id,$checkToken = false)
    {
        try {
            $hasMany = $this->has_many();
            foreach ($subforms as $form) {
                $ids = array(-1);

                $foreign_key = $hasMany[$form['relation']]['foreign_key'];
                $orm = $this->$form['relation'];
                $pk = $orm->primary_key();

                if (isset($data[$pk]) and is_array($data[$pk])) {
                    $columns = $orm->list_columns();
                    for($i=0;$i<count($data[$pk]);$i++)
                    {
                        $orm->clear();
                        $child = $orm->where($pk,'=',$data[$pk][$i])->find();
                        if (!$child->loaded()) {
                            $child = $orm->clear();
                        }
                        foreach ($columns as $col) {
                            if ($col['column_name'] != $pk)
                            {
                                if ($col['column_name'] == $foreign_key) {
                                    $child->$col['column_name'] = $parent_id;
                                } else {
                                    if (isset($data[$col['column_name']])) {
                                        $child->$col['column_name'] = $data[$col['column_name']][$i];
                                    }
                                }

                            }
                        }
                        $child->save();

                        $ids[] = $child->pk();
                    }

                    $this->clearSubformData($orm->table_name(),$foreign_key,$parent_id,$pk,$ids);
                }
            }

            return array('error'=>false,'reload'=>true);

        } catch(ORM_Validation_Exception $e) {
            return array('error'=>true,'type'=>'subform','messages'=>$e->errors());
        } /*catch(Exception $e) {
            return array('error'=>true,'type'=>'subform','messages'=>$e->getMessage());
        }*/
    }

    private function clearSubformData($table,$foreign_key,$parent_id,$primary_key,$ids){
        DB::delete($table)
            ->where($foreign_key,'=',$parent_id)
            ->where($primary_key,'NOT IN',$ids)
            ->execute();
    }

    private function saveHasManyData($data)
    {
        foreach($this->has_many() as $index=>$item)
        {
            if (!empty($item['through']) and isset($data[$index])) {
                $model = ORM::factory($item['model']);
                $pri = $model->primary_key();

                $oldValues = array();
                $oldValuesTemp = $this->$index->find_all();
                foreach($oldValuesTemp as $oValue)
                {
                    $oldValues[] = $oValue->$pri;
                }

                $currentValues = $data[$index];

                $addValue = array_diff($currentValues,$oldValues);
                $removeValue = array_diff($oldValues,$currentValues);

                if (array_search(-1,$addValue) !== false) {
                    unset($addValue[array_search(-1,$addValue)]);
                    $addValue = array_merge(array(),$addValue);
                }

                if (!empty($addValue)) $this->add($index,$addValue);
                if (!empty($removeValue)) $this->remove($index,$removeValue);
            }
        }

    }

    public function save(Validation $validation = NULL)
    {
        $this->customValidation($validation);

        if ($this->orderField) $this->updateOrder();

        $defaultLang = current(Kohana::$config->load('settings.frontendLangs'));
        $this->setDefaultValues();

        $this->logChanges();

        if (empty($this->_translate_fields) || $defaultLang == $this->currentLang || $this->currentLang === false) {
            parent::save();
            return $this;
        } else {

            foreach($this->_changed as $item)
            {
                if (in_array($item,$this->_translate_fields)) {

                    if (!is_array($this->$item))
                    {
                        $this->checkRecordExits($item,$this->$item,false,$this->currentLang);

                    } else {
                        foreach($this->$item as $lang=>$value)
                        {
                            if ($lang == $defaultLang) {
                                $this->checkRecordExits($item,$value,true,$lang);
                            } else {
                                $this->checkRecordExits($item,$value,false,$lang);
                            }

                        }
                    }

                } else {
                    $this->checkRecordExits($item,$this->$item);
                }
            }
        }

    }

    private function checkRecordExits($column,$value,$default = true,$lang = false)
    {
        if ($this->loaded()) {
            if ($default) {
                $row = array($column=>$value);

                $this->updateData($this->table_name(),$row,$this->primary_key(),$this->pk());
            } else {
                $this->createLanguagesTable();
                $tableName = $this->_table_name."_languages";
                $prefix = substr($this->table_name(),0,2);

                $hasLangRecord = $this->hasLangRecord($tableName,$this->pk(),$column,$lang);
                $row = $this->buildLanguageRow($this->pk(),$column,$lang,$value);
                if ($hasLangRecord) {
                   $this->updateData($tableName,$row,$prefix."l_id",$hasLangRecord[$prefix."l_id"]);
                } else {
                   $this->insertData($tableName,$row);
                }
            }
        } else {
            if ($default) {
                $row = array($column=>$value);
                $insert = $this->insertData($this->table_name(),$row);
                if (!$insert['error']) {
                    $this->_primary_key_value = $insert['id'];
                    $this->_loaded = true;
                } else throw new Exception("ORM save is faild: ".$insert['message']);

            } else {
                $this->createLanguagesTable();

                $mainRow = array();
                foreach($this->_table_columns as $key=>$item) {
                    if ($item['key'] != 'PRI') {
                        $mainRow[$key] = null;
                    }
                }

                $insert = $this->insertData($this->table_name(),$mainRow);

                if (!$insert['error']) {
                    $this->_primary_key_value = $insert['id'];
                    $this->_loaded = true;
                } else throw new Exception("ORM save is faild: ".$insert['message']);

            }

        }

    }

    private function updateData($table,array $set,$pri_name,$pri)
    {
        try {
            DB::update($table)
                ->set($set)
                ->where($pri_name,'=',$pri)
                ->execute();

            return array('error'=>false);
        } catch (Exception $e) {
            return array('error'=>true,'message'=>$e->getMessage());
        }

    }

    private function insertData($table,array $values)
    {
        try {
            $insert = DB::insert($table,array_keys($values))
                ->values($values)
                ->execute();

            return array('error'=>false,'id'=>$insert[0]);

        } catch (Exception $e) {
            return array('error'=>true,'message'=>$e->getMessage());
        }
    }

    protected function getElementName()
    {
        $nameFields = $this->getNamesFields();
        if ($nameFields == false) $nameFields = current(array_keys($this->list_columns()));
        $name = array();

        if (!array_key_exists('relation',$nameFields)) {
            foreach ($nameFields as $item) {
                if (isset($this->$item)) {
                    if (is_array($this->$item)) {
                       $temp = $this->$item;
                       $name[] = current($temp);
                    } else {
                       $name[] = $this->$item;
                    }
                }
            }
        } else {
            $relation = $nameFields['relation'];
            foreach ($nameFields['names'] as $item) {
                if (is_array($this->$relation->$item)) {
                   $temp = $this->$relation->$item;
                   $name[] = current($temp);
                } else {
                   $name[] = $this->$relation->$item;
                }
            }
        }

        return join(' ',$name);
    }

}
