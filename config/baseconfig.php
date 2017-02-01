<?php
/**
 * User: Tibor
 * Date: 2014.02.28.
 * Time: 13:05
 * Project: d2cadmin3.3
 * Company: d2c
 */
 
 if ( !isset($_SERVER['SERVER_NAME']) ) $_SERVER['SERVER_NAME'] = '127.0.0.1';

$config = array(
    //'remoteUrl'=>($_SERVER['SERVER_NAME'] == '127.0.0.1') ? 'http://127.0.0.1/d2cadmin_core' : 'http://core.design2code.hu',
    //'MODPATH'=>($_SERVER['SERVER_NAME'] == '127.0.0.1') ? realpath(APPPATH."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."d2cadmin_core").DIRECTORY_SEPARATOR : realpath('/var/www/virtual/design2code.hu/core/htdocs').DIRECTORY_SEPARATOR,

	'remoteUrl'=>'http://'.$_SERVER['SERVER_NAME'].'/gol/core',
    'MODPATH'=> realpath(APPPATH."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."core").DIRECTORY_SEPARATOR,
	
    'base_url'   => 'http://'.$_SERVER['SERVER_NAME'].'/gol',
    'database'   => 'gol',
    'username'   => 'root',
    'password'   => '',
);

return $config;