<?php
/**
 * User: Tibor
 * Date: 2015.08.24.
 * Time: 19:30
 * Project: enigma
 * Company: d2c
 */
trait Traits_ORM_Validations
{
    protected $_validation_messages = false;
    protected $_validation_dir = "models";

    function ajaxValidation($array)
    {
        $validation = Validation::factory($array);

        $rules = $this->get_scenario_rules();
        foreach($array as $index=>$item)
        {
            $cleanIndex = current(explode('_lang_',$index));
            if (array_key_exists($cleanIndex,$rules)) {
                $validation->rules($index,$rules[$cleanIndex]);
            }
        }

        if ($validation->check()) {
            return array('error'=>false);
        } else {
            return array('error'=>true,'messages'=>$validation->errors($this->_validation_dir.DIRECTORY_SEPARATOR.$this->_errors_filename));
        }
    }
	
	protected function getValidationFile()
    {
	    return $this->_validation_dir.DIRECTORY_SEPARATOR.$this->_errors_filename;
    }

    private function securityValidation($data)
    {
        if (!isset($data['csrf_token'])) $data['csrf_token'] = "";

        $validation = Validation::factory($data);

        $validation->rule('csrf_token','not_empty');
        $validation->rule('csrf_token','Security::check');

        if ($validation->check()) {
            return array('error'=>false);
        } else {
            throw new ORM_Validation_Exception(null,$validation, "Security error with csrf attack!");
        }
    }

    private function checkCaptcha($data)
    {
        $formName = (!empty($this->form)) ? $this->form : $this->_table_name;
        $form = Formbuilder::factory($formName,$this,true);

        if ($form->getHasCaptcha()) {
            $prefix = substr($this->_table_name,0,2);
                $validation = Validation::factory($data);
                $validation->rule($prefix.'_captcha','not_empty');
                $validation->rule($prefix.'_captcha','Captcha::valid');

                if (!$validation->check()) {
                    $this->_validation_dir = $this->_validation_dir.DIRECTORY_SEPARATOR.$this->table_name();
                    throw new ORM_Validation_Exception(null,$validation, "File upload is failed!");
                }
        }

        return array('error'=>false);
    }

    private function customValidation($validation)
    {
        $langs = Kohana::$config->load('settings.frontendLangs');

        if ($this->currentLang != "*" or empty($this->_translate_fields))
        {
            $this->currentLang = current($langs);
            $this->check($validation);
        } else {

            $currentObject = $this->_object;

            foreach($langs as $index=>$item) {

                $this->currentLang = $item;
                foreach($this->_table_columns as $column)
                {
                    if ($column['key'] != 'PRI') {

                        if (in_array($column['column_name'],$this->_translate_fields) and count($langs) > 1) {
                            $this->_object[$column['column_name']] = $currentObject[$column['column_name']][$item];
                        } else {
                            $this->_object[$column['column_name']] = $currentObject[$column['column_name']];

                        }
                    }
                }

                $this->check($validation);
            }

            $this->_object = $currentObject;
        }

    }

    protected function _validation()
    {
        // Build the validation object with its rules
        $langs = Kohana::$config->load('settings.frontendLangs');
        $this->_validation = Validation::factory($this->_object)
            ->bind(':model', $this)
            ->bind(':original_values', $this->_original_values)
            ->bind(':changed', $this->_changed)
            ->bind(':lang', $this->currentLang)
            ->bind(':tab', array_search($this->currentLang,$langs));

        $scenarioRules = $this->get_scenario_rules();
        foreach ($scenarioRules as $field => $rules)
        {
            $this->_validation->rules($field, $rules);
        }


        // Use column names by default for labels
        $columns = array_keys($this->_table_columns);

        // Merge user-defined labels
        $labels = array_merge(array_combine($columns, $columns), $this->labels());

        foreach ($labels as $field => $label)
        {
            $this->_validation->label($field, $label);
        }

    }

    public function get_scenario()
    {
       return ($this->loaded()) ? 'update' : 'create';
    }

    public function get_scenario_rules($scenario = false)
    {
        if (!$scenario) $scenario = $this->get_scenario();

        $newRules = array();
        foreach ($this->rules() as $field => $rules)
        {
            $scenarioRules = array();
            foreach($rules as $rule)
            {
                $lastParam = end($rule);
                if ($lastParam == 'update' || $lastParam == 'create') {
                    if ($lastParam == $scenario) {
                        unset($rule[count($rule)-1]);
                        $scenarioRules[] = $rule;
                    }

                } else {
                    $scenarioRules[] = $rule;
                }
            }

            $newRules[$field] = $scenarioRules;
        }

        return $newRules;
    }

    private function validationSubforms($data,$subforms)
    {
        $errors = array();
        foreach ($subforms as $form) {
            $orm = $this->$form['relation'];
            $pk = $orm->primary_key();
            $columns = $orm->list_columns();
            if (isset($data[$pk]) and is_array($data[$pk])) {
                foreach ($data[$pk] as $index => $pk_data)
                {
                    $validTemp = array();
                    foreach ($columns as $col) {
                        if (array_key_exists($col['column_name'],$data) and $col['column_name'] != $pk) {
                            $validTemp[$col['column_name']] = $data[$col['column_name']][$index];
                        }
                    }

                    $validation = $orm->ajaxValidation($validTemp);
                    if ($validation['error']) {
                        $errors[] = array(
                            'relation'=>$form['relation'],
                            'row'=>$index,
                            'messages'=>$validation['messages']
                        );
                    }
                }
            }

        }

        return array(
            'error'=>!empty($errors),
            'type'=>'subform',
            'messages'=>$errors,
            'lang'=>array(
                'lang'=>current(Kohana::$config->load('settings.frontendLangs')),
                'tab'=>0
            )
        );
    }

    public function getSelectValue($value)
    {
        if (!is_array($value)) {
            return ($value == -1) ? NULL : $value;
        }
    }
}