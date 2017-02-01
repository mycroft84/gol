<?php defined('SYSPATH') or die('No direct script access.');

// -- Environment setup --------------------------------------------------------

// Load the core Kohana class
require SYSPATH.'classes/Kohana/Core'.EXT;


if (is_file(APPPATH.'classes/Kohana'.EXT))
{
	// Application extends the core
	require APPPATH.'classes/Kohana'.EXT;
}
else
{
	// Load empty core extension
	require SYSPATH.'classes/Kohana'.EXT;
}

/**
 * Set the default time zone.
 *
 * @link http://kohanaframework.org/guide/using.configuration
 * @link http://www.php.net/manual/timezones
 */
date_default_timezone_set('Europe/Budapest');

/**
 * Set the default locale.
 *
 * @link http://kohanaframework.org/guide/using.configuration
 * @link http://www.php.net/manual/function.setlocale
 */
setlocale(LC_ALL, 'en_US.utf-8');

/**
 * Enable the Kohana auto-loader.
 *
 * @link http://kohanaframework.org/guide/using.autoloading
 * @link http://www.php.net/manual/function.spl-autoload-register
 */
spl_autoload_register(array('Kohana', 'auto_load'));

/**
 * Optionally, you can enable a compatibility auto-loader for use with
 * older modules that have not been updated for PSR-0.
 *
 * It is recommended to not enable this unless absolutely necessary.
 */
//spl_autoload_register(array('Kohana', 'auto_load_lowercase'));

/**
 * Enable the Kohana auto-loader for unserialization.
 *
 * @link http://www.php.net/manual/function.spl-autoload-call
 * @link http://www.php.net/manual/var.configuration#unserialize-callback-func
 */
ini_set('unserialize_callback_func', 'spl_autoload_call');

// -- Configuration and initialization -----------------------------------------

/**
 * Set the default language
 */
I18n::lang('en-us');

/**
 * Set Kohana::$environment if a 'KOHANA_ENV' environment variable has been supplied.
 *
 * Note: If you supply an invalid environment name, a PHP warning will be thrown
 * saying "Couldn't find constant Kohana::<INVALID_ENV_NAME>"
 */

Kohana::$environment = (!isset($_SERVER['SERVER_ADDR']) || $_SERVER['SERVER_ADDR'] == '127.0.0.1') ? Kohana::DEVELOPMENT : Kohana::PRODUCTION;
//Kohana::$environment = Kohana::PRODUCTION;

/**
 * Initialize Kohana, setting the default options.
 *
 * The following options are available:
 *
 * - string   base_url    path, and optionally domain, of your application   NULL
 * - string   index_file  name of your index file, usually "index.php"       index.php
 * - string   charset     internal character set used for input and output   utf-8
 * - string   cache_dir   set the internal cache directory                   APPPATH/cache
 * - integer  cache_life  lifetime, in seconds, of items cached              60
 * - boolean  errors      enable or disable error handling                   TRUE
 * - boolean  profile     enable or disable internal profiling               TRUE
 * - boolean  caching     enable or disable internal caching                 FALSE
 * - boolean  expose      set the X-Powered-By header                        FALSE
 */
$baseconfig = include realpath(APPPATH."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config").DIRECTORY_SEPARATOR."baseconfig.php";

Kohana::init(array(
	'base_url'   => $baseconfig['base_url'],
	'index_file' => false,
	'errors'	 =>	true,
	'profile'	 =>	true,
    'cache'      => true,
	'cache_dir'  => APPPATH.'/cache'
));

/**
 * Attach the file write to logging. Multiple writers are supported.
 */
Kohana::$log->attach(new Log_File(APPPATH.'logs'));

/**
 * Attach a file reader to config. Multiple readers are supported.
 */
Kohana::$config->attach(new Config_File);

/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 */

Kohana::modules(array(
	'auth'              => $baseconfig['MODPATH'].'auth',       // Basic authentication
    // 'unittest'   => MODPATH.'unittest',   // Unit testing
	// 'userguide'  => MODPATH.'userguide',  // User guide and API documentation
    // 'codebench'  => MODPATH.'codebench',  // Benchmarking tool
    
	'cache'             => $baseconfig['MODPATH'].'cache',      // Caching with multiple backends
	'database'          => $baseconfig['MODPATH'].'database',   // Database access
	'mysqli'      		=> $baseconfig['MODPATH'].'mysqli',   // mysqli 
	'image'             => $baseconfig['MODPATH'].'image',      // Image manipulation
	'minion'            => $baseconfig['MODPATH'].'minion',     // CLI Tasks
	'orm'               => $baseconfig['MODPATH'].'orm',        // Object Relationship Mapping
    'twig'              => $baseconfig['MODPATH'].'twig',
    'jshelper'          => $baseconfig['MODPATH'].'jshelper',
    'assets'            => $baseconfig['MODPATH'].'assets',
    'files'             => $baseconfig['MODPATH'].'files',
    'accesscontrol'     => $baseconfig['MODPATH'].'accesscontrol',
    'formbuilder'       => $baseconfig['MODPATH'].'formbuilder',
    'fuzzyspan'         => $baseconfig['MODPATH'].'fuzzyspan',
    'pager'           	=> $baseconfig['MODPATH'].'pager',
    'containers'        => $baseconfig['MODPATH'].'containers',
	'storages'        => $baseconfig['MODPATH'].'storages',
	'helpers'        => $baseconfig['MODPATH'].'helpers',
	'restful'        => $baseconfig['MODPATH'].'restful',

    'gol'        => MODPATH.'gol',
    'api'        => MODPATH.'api',

	));

require "config/routing.php";
require "config/assets.php";
require "config/accesscontrol.php";