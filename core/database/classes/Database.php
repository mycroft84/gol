<?php defined('SYSPATH') OR die('No direct script access.');

abstract class Database extends Kohana_Database {

    /**
     * Get the tables foreign key
     *
     * @param mixed $table
     * @return mixed
     */
    static function getForeignKey($table,$first=true)
    {
        if ($table == '') return false;

        $db = Kohana::$config->load('database.default.connection.database');

        $data = DB::query(Database::SELECT,"SELECT  REFERENCED_TABLE_NAME as 'table',
                                                    REFERENCED_COLUMN_NAME as 'column',
                                                    COLUMN_NAME as 'key',
                                                    TABLE_NAME as 'original_table'
										FROM information_schema.KEY_COLUMN_USAGE
										WHERE TABLE_NAME = :table AND
                                        CONSTRAINT_SCHEMA = :db AND
										CONSTRAINT_NAME <>'PRIMARY' AND REFERENCED_TABLE_NAME is not null")
            ->bind(':table',$table)
            ->bind(':db',$db)
            ->execute();

        if ($first) $data = $data->current();
        else {
            $data_temp = $data->as_array();
            $data = array();
            foreach($data_temp as $item)
            {
                $data[$item['key']] = $item;
            }

        }
        return $data;
    }

    static function getPrimaryKey($table)
    {
        if ($table == '') return false;

        $data = Database::instance()->list_columns($table);
        $prikey = array();

        foreach($data as $key=>$value)
        {
            if ($value['key'] == 'PRI') $prikey[] = $key;
        }

        return $prikey;
    }

}
