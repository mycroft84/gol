<?php
/**
 * User: Tibor
 * Date: 2015.08.24.
 * Time: 19:33
 * Project: enigma
 * Company: d2c
 */
trait Traits_ORM_Translate
{
    protected $_translate_fields = array();
    protected $currentLang = false;

    protected $is_translate_orm = false;

    public function getTranslateFields()
    {
       return $this->_translate_fields;
    }

    public function getCurrentLang()
    {
       return $this->currentLang;
    }

    public function createLanguagesTable()
    {
        $tableName = $this->_table_name."_languages";
        $prefix = substr($this->_table_name,0,2);
        $notHasTable = ! count(Database::instance()->list_tables($tableName));

        if ($notHasTable) {
            $sql = "CREATE TABLE `".$tableName."` (
                  `".$prefix."l_id` int(11) NOT NULL AUTO_INCREMENT,
                  `".$prefix."l_ref_id` int(11) DEFAULT NULL,
                  `".$prefix."l_lang` varchar(2) DEFAULT NULL,
                  `".$prefix."l_column_name` varchar(255) DEFAULT NULL,
                  `".$prefix."l_value` text,
                  PRIMARY KEY (`".$prefix."l_id`),
                  UNIQUE KEY `".$prefix."l_id` (`".$prefix."l_id`),
                  KEY `".$prefix."l_ref_id` (`".$prefix."l_ref_id`),
                  KEY `".$prefix."l_lang` (`".$prefix."l_lang`),
                  KEY `".$prefix."l_column_name` (`".$prefix."l_column_name`),
                  CONSTRAINT `".$tableName."_".$prefix."l_ref_id` FOREIGN KEY (`".$prefix."l_ref_id`) REFERENCES `".$this->_table_name."` (`".$this->_primary_key."`) ON DELETE CASCADE ON UPDATE CASCADE
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

            try {
                DB::query(null,$sql)->execute();

                $this->createTranslateView();

                return array('error'=>false);
            } catch (Exception $e) {
                echo Debug::vars($e->getMessage());
                return array('error'=>true,'message'=>$e->getMessage());
            }
        } else return array('error'=>false,'message'=>"'".$tableName."' table is already exits!");
    }

    public function createTranslateView($force = false)
    {
        if (Kohana::$environment == Kohana::PRODUCTION and $force == false) return false;

        $this->createSummaryTranslateView();
        $this->createLangTranslateView();
		$this->createTranslateOrm();
    }

    private function createSummaryTranslateView()
    {
        $langs = Kohana::$config->load('settings.frontendLangs');
        $defaultLang = current($langs);
        $columns = $this->_table_columns;
        $langTableName = $this->_table_name."_languages";
        $prefix = substr($this->_table_name,0,2);

        $langField = $langTableName.".".$prefix."l_lang";

        $sqlString = "
            CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER  VIEW `".$this->_table_name."_lang_view` AS";

        $sqlString.= "
        SELECT
        '".$defaultLang."' as lang,
        `".$this->_table_name."`.*
        FROM `".$this->_table_name."`";

        foreach ($langs as $index=>$item) {
            if ($index) {
                $sqlString .= "
                    UNION
                    SELECT
                        (SELECT $langField FROM $langTableName WHERE $langTableName.$prefix" . "l_ref_id = `" . $this->_table_name . "`." . $this->_primary_key . " AND " . $langField . " = '$item' GROUP BY " . $langTableName . "." . $prefix . "l_ref_id, $langField) as lang,";

                foreach ($columns as $col) {
                    if (in_array($col['column_name'],$this->_translate_fields)) {
                        $sqlString .= "
                        (
                            SELECT $langTableName.".$prefix."l_value AS ".$col['column_name']."
                            FROM $langTableName
                            WHERE
                                $langTableName.".$prefix."l_ref_id = `" . $this->_table_name . "`." . $this->_primary_key . "
                                AND $langTableName.".$prefix."l_column_name = '".$col['column_name']."'
                                AND $langTableName.".$prefix."l_lang = '$item'
                        ) as ".$col['column_name'].",";
                    } else {
                        $sqlString .= "
                        `".$this->_table_name."`.".$col['column_name']." as ".$col['column_name'].",";
                    }
                }

                $sqlString = rtrim($sqlString,',');

                $sqlString .= "
                    FROM `$this->_table_name`
                    WHERE (
                        SELECT $langTableName.".$prefix."l_lang
                        FROM $langTableName
                        WHERE
                            $langTableName.".$prefix."l_ref_id = `$this->_table_name`".".$this->_primary_key
                            AND $langTableName.".$prefix."l_lang = '$item'
                        GROUP BY $langTableName.".$prefix."l_ref_id, $langTableName.".$prefix."l_lang
                    ) IS NOT NULL
                ";
            }
        }

        //echo $sqlString;

        DB::query(null,$sqlString)->execute();
    }

    private function createLangTranslateView()
    {
        $langs = Kohana::$config->load('settings.frontendLangs');
        $columns = $this->_table_columns;
        $langTableName = $this->_table_name."_languages";
        $prefix = substr($this->_table_name,0,2);

        $langField = $langTableName.".".$prefix."l_lang";

        foreach ($langs as $index=>$item) {

            if ($index) {
                $sqlString = "
                    CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER  VIEW `".$this->_table_name."_lang_".$item."_view` AS
                    SELECT
                        (SELECT $langField FROM $langTableName WHERE $langTableName.$prefix" . "l_ref_id = " . $this->_table_name . "." . $this->_primary_key . " AND " . $langField . " = '$item' GROUP BY " . $langTableName . "." . $prefix . "l_ref_id, $langField) as lang,";

                foreach ($columns as $col) {
                    if (in_array($col['column_name'],$this->_translate_fields)) {
                        $sqlString .= "
                        (
                            SELECT $langTableName.".$prefix."l_value AS ".$col['column_name']."
                            FROM $langTableName
                            WHERE
                                $langTableName.".$prefix."l_ref_id = " . $this->_table_name . "." . $this->_primary_key . "
                                AND $langTableName.".$prefix."l_column_name = '".$col['column_name']."'
                                AND $langTableName.".$prefix."l_lang = '$item'
                        ) as ".$col['column_name'].",";
                    } else {
                        $sqlString .= "
                        $this->_table_name.".$col['column_name']." as ".$col['column_name'].",";
                    }
                }

                $sqlString = rtrim($sqlString,',');

                $sqlString .= "
                    FROM $this->_table_name
                    WHERE (
                        SELECT $langTableName.".$prefix."l_lang
                        FROM $langTableName
                        WHERE
                            $langTableName.".$prefix."l_ref_id = $this->_table_name".".$this->_primary_key
                            AND $langTableName.".$prefix."l_lang = '$item'
                        GROUP BY $langTableName.".$prefix."l_ref_id, $langTableName.".$prefix."l_lang
                    ) IS NOT NULL
                ";

                DB::query(null,$sqlString)->execute();
            }
        }
    }

    public function createTranslateOrm()
    {
        $reflector = new ReflectionClass(get_class($this));
        $original_file = $reflector->getFileName();
        $str = 'classes'.DIRECTORY_SEPARATOR.'Model';
        $pos = strpos($original_file,$str);
        $langs = Kohana::$config->load('settings.frontendLangs');
        if ($pos !== false) {
            foreach ($langs as $index=>$item) {
                if ($index == 0) {
                    $newFile = substr($original_file, 0, $pos + strlen($str)) . DIRECTORY_SEPARATOR . 'Translate' . substr($original_file, $pos + strlen($str));
                    $className = 'Model_Translate' . substr($reflector->getName(), strlen('Model'));

                    if (!is_file($newFile)) {
                        $this->createTranslateFolders($newFile);

                        $content = Twig::get_template_content('ORM/translate.twig', array(
                            'classname' => $className,
                            'table_name' => $this->view_name(),
                            'primary_key' => $this->primary_key()
                        ));

                        file_put_contents($newFile, $content);
                    }
                } else {
                    $newFile = substr($original_file, 0, $pos + strlen($str)) . DIRECTORY_SEPARATOR . 'Translate' .DIRECTORY_SEPARATOR.ucfirst($item). substr($original_file, $pos + strlen($str));
                    $dir = substr($original_file, 0, $pos + strlen($str)) . DIRECTORY_SEPARATOR . 'Translate' .DIRECTORY_SEPARATOR.ucfirst($item);
                    $className = 'Model_Translate_'.ucfirst($item) . substr($reflector->getName(), strlen('Model'));

                    if (!is_file($newFile)) {
                        $this->createTranslateFolders($newFile);

                        $content = Twig::get_template_content('ORM/translate.twig', array(
                            'classname' => $className,
                            'table_name' => $this->view_name($item),
                            'primary_key' => $this->primary_key()
                        ));

                        file_put_contents($newFile, $content);
                    }
                }
            }
        }
    }

    private function createTranslateFolders($file)
    {
        $str = 'classes'.DIRECTORY_SEPARATOR.'Model'.DIRECTORY_SEPARATOR;

        $start = substr($file,0,strpos($file,$str)  + strlen($str));
        $end = substr($file,strpos($file,$str) + strlen($str));
        $parts = explode(DIRECTORY_SEPARATOR,$end);

        $dir = rtrim($start,DIRECTORY_SEPARATOR);
        foreach ($parts as $index=>$item) {
            if ($index+1 != count($parts)) {
                $dir.= DIRECTORY_SEPARATOR.$item;
                if (!is_dir($dir)) {
                    mkdir($dir,0777);
                }
            }
        }

    }

    public function setLang($lang)
    {
        $this->currentLang = $lang;
    }

    public function view_name($lang = false)
    {
        return ($lang and $lang != '*') ? $this->_table_name."_lang_".$lang."_view" : $this->_table_name."_lang_view";
    }

    public function getViewName($lang = null)
    {
        $result = array('Translate');
        if ($lang and $lang != '*') $result[] = ucfirst($lang);
        foreach (explode('_', $this->_object_name) as $item) {
            $result[] = ucfirst($item);
        }

        return join('_',$result);
    }

    protected function changeRecordLang($lang)
    {
        $fLangs = Kohana::$config->load('settings.frontendLangs');

        if ($this->is_translate_orm || empty($this->_translate_fields) || count($fLangs) == 1) return parent::find();

        $this->createLanguagesTable();
        $this->createTranslateView();
        $this->createTranslateOrm();

        $viewORM = $this->getViewName($lang);
        $view = ORM::factory($viewORM);
        $view->_db_pending = $this->convertPending($this->_db_pending,$view->_object_name);
        $view->_belongs_to = $this->_belongs_to;
        $view->_with_applied = $this->_with_applied;
        $view->_related = $this->_related;
        $view->enabledField = $this->enabledField;
        $view->orderField = $this->orderField;
        $view->orderDependencies = $this->orderDependencies;

        /*echo Debug::vars($this,$view);
        exit;/**/

        if ($lang != '*')
        {
            $view->where('lang','=',$lang);
            $view = $view->find();

            $this->queries[] = Database::instance()->last_query;

            $this->clear();
            $this->currentLang = $lang;
            $this->_primary_key_value = $view->{$this->primary_key()};
            foreach ($this->_table_columns as $index=>$item) {
                $this->$index = $view->$index;
            }
            $this->_related = $view->_related;

            $this->_loaded = $view->loaded();

        } else {

            $views = $view->find_all();

            $this->queries[] = Database::instance()->last_query;

            $this->clear();
            $this->currentLang = '*';
            foreach ($views as $item) {
                foreach ($this->_table_columns as $cIndex=>$cItem) {
                    if (in_array($cIndex,$this->_translate_fields)) {
                        if (!is_array($this->$cIndex)) {
                            $this->$cIndex = array();
                        }

                        $langArray = $this->$cIndex;
                        $langArray[$item->lang] = $item->$cIndex;

                        $this->$cIndex = $langArray;
                    } else {
                        $this->$cIndex = $item->$cIndex;
                    }

                    $this->_primary_key_value = $item->{$this->primary_key()};
                }
            }
            $this->_related = $view->_related;
            $this->_loaded = (bool) (count($views));
        }

        $this->_changed = array();
    }

    public function findInViewTable($lang)
    {
        $fLangs = Kohana::$config->load('settings.frontendLangs');
        if ($this->is_translate_orm || empty($this->_translate_fields) || count($fLangs) == 1) return parent::find_all();

        $this->createLanguagesTable();
        $this->createTranslateView();
        $this->createTranslateOrm();

        $viewORM = $this->getViewName($lang);
        $view = ORM::factory($viewORM);
        $view->_db_pending = $this->convertPending($this->_db_pending,$view->_object_name);
        $view->_belongs_to = $this->_belongs_to;
        $view->_with_applied = $this->_with_applied;
        $view->_related = $this->_related;
        $view->enabledField = $this->enabledField;
        $view->orderField = $this->orderField;
        $view->orderDependencies = $this->orderDependencies;

        /*echo Debug::vars($this,$view);
        exit;/**/

        $result = array();

        if ($lang != '*')
        {
            $view->where('lang','=',$lang);
            $viewAll = $view->find_all();
            
            $this->queries[] = Database::instance()->last_query;

            foreach ($viewAll as $item) {

                $clone = clone $this;
                //$clone = $clone->clear();
                $clone->currentLang = $lang;
                $clone->_primary_key_value = $item->{$this->primary_key()};

                foreach ($this->_table_columns as $cIndex=>$cItem) {
                    $clone->$cIndex = $item->$cIndex;
                }

                $clone->_loaded = true;
                $clone->_changed = array();
                $clone->_belongs_to = $this->_belongs_to;
                $clone->_with_applied = $this->_with_applied;

                $result[] = $clone;
            }

        } else {

            $view = $view->find_all();
            $original = clone $this;

            foreach ($view as $item) {
                if (!array_key_exists($item->{$original->primary_key()},$result)) {
                    $clone = clone $original;
                    $clone = $clone->clear();

                    $result[$item->{$original->primary_key()}] = $clone;
                }

                $currentItem = $result[$item->{$original->primary_key()}];
                $currentItem->_primary_key_value = $item->{$original->primary_key()};

                foreach ($this->_table_columns as $cIndex=>$cItem) {
                    if (in_array($cIndex,$this->_translate_fields)) {
                        if (!is_array($currentItem->$cIndex)) {
                            $currentItem->$cIndex = array();
                        }

                        $langArray = $currentItem->$cIndex;
                        $langArray[$item->lang] = $item->$cIndex;

                        $currentItem->$cIndex = $langArray;
                    } else {
                        $currentItem->$cIndex = $item->$cIndex;
                    }
                }

                $currentItem->_loaded = true;
                $currentItem->_changed = array();
            }

        }

        return $result;
    }

    private function convertPending($pend,$object_name)
    {
        $pending = $pend;

        foreach ($pending as &$item) {
            foreach ($item['args'] as &$attr) {
                if (is_array($attr) or is_null($attr) or is_object($attr)) continue;

                $position = strpos($attr,$this->_object_name.'.');
                if ($position == 0) {
                    $attr = str_replace($this->_object_name . '.', $object_name . '.', $attr);
                }
            }
        }

        //echo Debug::vars($pend,$pending);
        
        return $pending;
    }

    private function hasLangRecord($tableName,$ref_id,$column,$lang)
    {
        $prefix = substr($this->table_name(),0,2);

        return DB::select()
            ->from($tableName)
            ->where($prefix.'l_ref_id','=',$ref_id)
            ->where($prefix.'l_lang','=',$lang)
            ->where($prefix.'l_column_name','=',$column)
            ->execute()->current();
    }

    private function buildLanguageRow($ref_id,$column,$lang,$value)
    {
        $prefix = substr($this->table_name(),0,2);

        return array(
            $prefix.'l_ref_id'=>$ref_id,
            $prefix.'l_lang'=>$lang,
            $prefix.'l_column_name'=>$column,
            $prefix.'l_value'=>$value
        );
    }


}