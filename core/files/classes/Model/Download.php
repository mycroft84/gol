<?php

class Model_Download extends Model
{
    static function download($where,$table = 'files',$file = 'fi_url', $name='fi_original_name')
    {
        $data = DB::select( array($file,'file'),
                            array($name,'name')
                            )
                        ->from($table);
        foreach($where as $index=>$value)
        {
            $data->where($index,'=',$value);
        }
        
        $data = $data->execute()->current();

        File::force_download($data['name'],Storages::instance()->getFileContent($data['file']));
    }

    public static function preview($where,$table = 'files',$file = 'fi_url', $name='fi_name')
    {
        $data = DB::select( array($file,'file'),
            array($name,'name')
        )
            ->from($table);
        foreach($where as $index=>$value)
        {
            $data->where($index,'=',$value);
        }
        $data = $data->execute()->current();

        $file = Kohana::$config->load('settings.userfilesRealPath').DIRECTORY_SEPARATOR.str_replace('/',DIRECTORY_SEPARATOR,$data['file']);

        return $file;
    }
}