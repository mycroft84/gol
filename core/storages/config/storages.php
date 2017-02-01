<?php
/**
 * User: Tibi
 * Date: 2015.10.21.
 * Time: 9:39
 * Project: redmozi_web
 * Company: d2c
 */
return array(
    'ftp'=>array(
        'type'=>'ftp',
        'login'=>array(
            'host'=>'admin-dc19.design2code.hu',
            'port'=>21,
            'username'=>'d2c-deploy',
            'password'=>'qiz2ik',
        ),
        'baseUploadDir'=>'htdocs',
        'uploadDir'=>'uploads',
        'baseUrl'=>'http://deployments.design2code.hu',
        'ssl'=>false
    ),
    'default'=>array(
        'type'=>'local',
        'uploadDir'=>Kohana::$config->load('settings.userfilesRealPath').DIRECTORY_SEPARATOR,
        'baseUrl'=>Kohana::$config->load('settings.userfilesUrl'),
    ),
);