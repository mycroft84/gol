<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2017-02-01 09:11:03 --- CRITICAL: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'sitemap' at 'C:\xampp\htdocs\gol\core\sitemap' ~ SYSPATH\classes\Kohana\Core.php [ 579 ] in C:\xampp\htdocs\gol\frontend\application\bootstrap.php:144
2017-02-01 09:11:03 --- DEBUG: #0 C:\xampp\htdocs\gol\frontend\application\bootstrap.php(144): Kohana_Core::modules(Array)
#1 C:\xampp\htdocs\gol\frontend\index.php(105): require('C:\\xampp\\htdocs...')
#2 {main} in C:\xampp\htdocs\gol\frontend\application\bootstrap.php:144
2017-02-01 09:11:22 --- CRITICAL: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'mailer' at 'C:\xampp\htdocs\gol\core\mailer' ~ SYSPATH\classes\Kohana\Core.php [ 579 ] in C:\xampp\htdocs\gol\frontend\application\bootstrap.php:143
2017-02-01 09:11:22 --- DEBUG: #0 C:\xampp\htdocs\gol\frontend\application\bootstrap.php(143): Kohana_Core::modules(Array)
#1 C:\xampp\htdocs\gol\frontend\index.php(105): require('C:\\xampp\\htdocs...')
#2 {main} in C:\xampp\htdocs\gol\frontend\application\bootstrap.php:143
2017-02-01 09:11:28 --- CRITICAL: Database_Exception [ 1146 ]: Table 'gol.settings' doesn't exist [ SHOW FULL COLUMNS FROM `settings` ] ~ C:\xampp\htdocs\gol\core\mysqli\classes\Database\MySQLi.php [ 175 ] in C:\xampp\htdocs\gol\core\mysqli\classes\Database\MySQLi.php:339
2017-02-01 09:11:28 --- DEBUG: #0 C:\xampp\htdocs\gol\core\mysqli\classes\Database\MySQLi.php(339): Database_MySQLi->query(1, 'SHOW FULL COLUM...', false)
#1 C:\xampp\htdocs\gol\core\orm\classes\Kohana\ORM.php(1666): Database_MySQLi->list_columns('settings')
#2 C:\xampp\htdocs\gol\core\orm\classes\Kohana\ORM.php(441): Kohana_ORM->list_columns()
#3 C:\xampp\htdocs\gol\core\orm\classes\Kohana\ORM.php(386): Kohana_ORM->reload_columns()
#4 C:\xampp\htdocs\gol\core\orm\classes\Kohana\ORM.php(254): Kohana_ORM->_initialize()
#5 C:\xampp\htdocs\gol\core\orm\classes\ORM.php(32): Kohana_ORM->__construct(NULL)
#6 C:\xampp\htdocs\gol\frontend\application\config\settings.php(3): ORM::factory('settings')
#7 C:\xampp\htdocs\gol\core\system\classes\Kohana\Core.php(829): include('C:\\xampp\\htdocs...')
#8 C:\xampp\htdocs\gol\core\system\classes\Kohana\Config\File\Reader.php(49): Kohana_Core::load('C:\\xampp\\htdocs...')
#9 C:\xampp\htdocs\gol\core\system\classes\Kohana\Config.php(130): Kohana_Config_File_Reader->load('settings')
#10 C:\xampp\htdocs\gol\core\system\classes\Route.php(44): Kohana_Config->load('settings.fronte...')
#11 C:\xampp\htdocs\gol\core\system\classes\Request.php(8): Route::createI18nRoutes()
#12 C:\xampp\htdocs\gol\core\system\classes\Request.php(36): Request::process(Object(Request), Array)
#13 C:\xampp\htdocs\gol\frontend\index.php(121): Request->execute()
#14 {main} in C:\xampp\htdocs\gol\core\mysqli\classes\Database\MySQLi.php:339
2017-02-01 09:11:41 --- CRITICAL: Database_Exception [ 1146 ]: Table 'gol.statictext' doesn't exist [ SHOW FULL COLUMNS FROM `statictext` ] ~ C:\xampp\htdocs\gol\core\mysqli\classes\Database\MySQLi.php [ 175 ] in C:\xampp\htdocs\gol\core\mysqli\classes\Database\MySQLi.php:339
2017-02-01 09:11:41 --- DEBUG: #0 C:\xampp\htdocs\gol\core\mysqli\classes\Database\MySQLi.php(339): Database_MySQLi->query(1, 'SHOW FULL COLUM...', false)
#1 C:\xampp\htdocs\gol\core\orm\classes\Kohana\ORM.php(1666): Database_MySQLi->list_columns('statictext')
#2 C:\xampp\htdocs\gol\core\orm\classes\Kohana\ORM.php(441): Kohana_ORM->list_columns()
#3 C:\xampp\htdocs\gol\core\orm\classes\Kohana\ORM.php(386): Kohana_ORM->reload_columns()
#4 C:\xampp\htdocs\gol\core\orm\classes\Kohana\ORM.php(254): Kohana_ORM->_initialize()
#5 C:\xampp\htdocs\gol\core\orm\classes\ORM.php(32): Kohana_ORM->__construct(NULL)
#6 C:\xampp\htdocs\gol\frontend\application\classes\Model\Staticpage.php(18): ORM::factory('languages')
#7 [internal function]: Model_Staticpage::routing(Object(Route), Array, Object(Request))
#8 C:\xampp\htdocs\gol\core\system\classes\Kohana\Route.php(462): call_user_func(Array, Object(Route), Array, Object(Request))
#9 C:\xampp\htdocs\gol\core\system\classes\Request.php(20): Kohana_Route->matches(Object(Request))
#10 C:\xampp\htdocs\gol\core\system\classes\Request.php(36): Request::process(Object(Request), Array)
#11 C:\xampp\htdocs\gol\frontend\index.php(121): Request->execute()
#12 {main} in C:\xampp\htdocs\gol\core\mysqli\classes\Database\MySQLi.php:339
2017-02-01 09:11:55 --- CRITICAL: Database_Exception [ 1146 ]: Table 'gol.staticpage' doesn't exist [ SHOW FULL COLUMNS FROM `staticpage` ] ~ C:\xampp\htdocs\gol\core\mysqli\classes\Database\MySQLi.php [ 175 ] in C:\xampp\htdocs\gol\core\mysqli\classes\Database\MySQLi.php:339
2017-02-01 09:11:55 --- DEBUG: #0 C:\xampp\htdocs\gol\core\mysqli\classes\Database\MySQLi.php(339): Database_MySQLi->query(1, 'SHOW FULL COLUM...', false)
#1 C:\xampp\htdocs\gol\core\orm\classes\Kohana\ORM.php(1666): Database_MySQLi->list_columns('staticpage')
#2 C:\xampp\htdocs\gol\core\orm\classes\Kohana\ORM.php(441): Kohana_ORM->list_columns()
#3 C:\xampp\htdocs\gol\core\orm\classes\Kohana\ORM.php(386): Kohana_ORM->reload_columns()
#4 C:\xampp\htdocs\gol\core\orm\classes\Kohana\ORM.php(254): Kohana_ORM->_initialize()
#5 C:\xampp\htdocs\gol\core\orm\classes\ORM.php(32): Kohana_ORM->__construct(NULL)
#6 C:\xampp\htdocs\gol\frontend\application\classes\Model\Staticpage.php(20): ORM::factory('staticpage')
#7 [internal function]: Model_Staticpage::routing(Object(Route), Array, Object(Request))
#8 C:\xampp\htdocs\gol\core\system\classes\Kohana\Route.php(462): call_user_func(Array, Object(Route), Array, Object(Request))
#9 C:\xampp\htdocs\gol\core\system\classes\Request.php(20): Kohana_Route->matches(Object(Request))
#10 C:\xampp\htdocs\gol\core\system\classes\Request.php(36): Request::process(Object(Request), Array)
#11 C:\xampp\htdocs\gol\frontend\index.php(121): Request->execute()
#12 {main} in C:\xampp\htdocs\gol\core\mysqli\classes\Database\MySQLi.php:339
2017-02-01 09:12:17 --- CRITICAL: Database_Exception [ 1146 ]: Table 'gol.metadata' doesn't exist [ SHOW FULL COLUMNS FROM `metadata` ] ~ C:\xampp\htdocs\gol\core\mysqli\classes\Database\MySQLi.php [ 175 ] in C:\xampp\htdocs\gol\core\mysqli\classes\Database\MySQLi.php:339
2017-02-01 09:12:17 --- DEBUG: #0 C:\xampp\htdocs\gol\core\mysqli\classes\Database\MySQLi.php(339): Database_MySQLi->query(1, 'SHOW FULL COLUM...', false)
#1 C:\xampp\htdocs\gol\core\orm\classes\Kohana\ORM.php(1666): Database_MySQLi->list_columns('metadata')
#2 C:\xampp\htdocs\gol\core\orm\classes\Kohana\ORM.php(441): Kohana_ORM->list_columns()
#3 C:\xampp\htdocs\gol\core\orm\classes\Kohana\ORM.php(386): Kohana_ORM->reload_columns()
#4 C:\xampp\htdocs\gol\core\orm\classes\Kohana\ORM.php(254): Kohana_ORM->_initialize()
#5 C:\xampp\htdocs\gol\core\orm\classes\ORM.php(32): Kohana_ORM->__construct(NULL)
#6 C:\xampp\htdocs\gol\frontend\application\classes\Controller\DefaultTemplate.php(79): ORM::factory('metadata')
#7 C:\xampp\htdocs\gol\core\system\classes\Controller.php(28): Controller_DefaultTemplate->after()
#8 [internal function]: Controller->execute()
#9 C:\xampp\htdocs\gol\core\system\classes\Kohana\Request\Client\Internal.php(97): ReflectionMethod->invoke(Object(Controller_Main))
#10 C:\xampp\htdocs\gol\core\system\classes\Kohana\Request\Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#11 C:\xampp\htdocs\gol\core\system\classes\Request.php(85): Kohana_Request_Client->execute(Object(Request))
#12 C:\xampp\htdocs\gol\frontend\index.php(121): Request->execute()
#13 {main} in C:\xampp\htdocs\gol\core\mysqli\classes\Database\MySQLi.php:339
2017-02-01 09:13:30 --- CRITICAL: ErrorException [ 8 ]: Undefined index: defaults ~ C:\xampp\htdocs\gol\core\assets\classes\Kohana\AssetManager.php [ 121 ] in C:\xampp\htdocs\gol\core\assets\classes\Kohana\AssetManager.php:121
2017-02-01 09:13:30 --- DEBUG: #0 C:\xampp\htdocs\gol\core\assets\classes\Kohana\AssetManager.php(121): Kohana_Core::error_handler(8, 'Undefined index...', 'C:\\xampp\\htdocs...', 121, Array)
#1 C:\xampp\htdocs\gol\frontend\application\classes\Controller\DefaultTemplate.php(51): Kohana_AssetManager->getRequestAssets(Object(Request))
#2 C:\xampp\htdocs\gol\core\system\classes\Controller.php(28): Controller_DefaultTemplate->after()
#3 [internal function]: Controller->execute()
#4 C:\xampp\htdocs\gol\core\system\classes\Kohana\Request\Client\Internal.php(97): ReflectionMethod->invoke(Object(Controller_Main))
#5 C:\xampp\htdocs\gol\core\system\classes\Kohana\Request\Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 C:\xampp\htdocs\gol\core\system\classes\Request.php(85): Kohana_Request_Client->execute(Object(Request))
#7 C:\xampp\htdocs\gol\frontend\index.php(121): Request->execute()
#8 {main} in C:\xampp\htdocs\gol\core\assets\classes\Kohana\AssetManager.php:121
2017-02-01 09:18:21 --- CRITICAL: Exception [ 0 ]: sites/default.js not found in :C:\xampp\htdocs\gol\frontend\media\js\, C:\xampp\htdocs\gol\core\image\media\js\, C:\xampp\htdocs\gol\core\files\media\js\ ~ C:\xampp\htdocs\gol\core\assets\classes\Kohana\Assets.php [ 66 ] in C:\xampp\htdocs\gol\core\assets\classes\Kohana\Assets.php:94
2017-02-01 09:18:21 --- DEBUG: #0 C:\xampp\htdocs\gol\core\assets\classes\Kohana\Assets.php(94): Kohana_Assets->add('sites/default.j...', 'js', false)
#1 C:\xampp\htdocs\gol\frontend\application\classes\Controller\DefaultTemplate.php(66): Kohana_Assets->js('sites/default.j...')
#2 C:\xampp\htdocs\gol\core\system\classes\Controller.php(28): Controller_DefaultTemplate->after()
#3 [internal function]: Controller->execute()
#4 C:\xampp\htdocs\gol\core\system\classes\Kohana\Request\Client\Internal.php(97): ReflectionMethod->invoke(Object(Controller_Main))
#5 C:\xampp\htdocs\gol\core\system\classes\Kohana\Request\Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 C:\xampp\htdocs\gol\core\system\classes\Request.php(85): Kohana_Request_Client->execute(Object(Request))
#7 C:\xampp\htdocs\gol\frontend\index.php(121): Request->execute()
#8 {main} in C:\xampp\htdocs\gol\core\assets\classes\Kohana\Assets.php:94
2017-02-01 09:23:43 --- CRITICAL: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'gol' at 'C:\xampp\htdocs\gol\core\gol' ~ SYSPATH\classes\Kohana\Core.php [ 579 ] in C:\xampp\htdocs\gol\frontend\application\bootstrap.php:142
2017-02-01 09:23:43 --- DEBUG: #0 C:\xampp\htdocs\gol\frontend\application\bootstrap.php(142): Kohana_Core::modules(Array)
#1 C:\xampp\htdocs\gol\frontend\index.php(105): require('C:\\xampp\\htdocs...')
#2 {main} in C:\xampp\htdocs\gol\frontend\application\bootstrap.php:142
2017-02-01 09:25:36 --- CRITICAL: Kohana_Exception [ 0 ]: The requested route does not exist: login ~ SYSPATH\classes\Route.php [ 330 ] in C:\xampp\htdocs\gol\core\system\classes\Route.php:133
2017-02-01 09:25:36 --- DEBUG: #0 C:\xampp\htdocs\gol\core\system\classes\Route.php(133): Route::get('login', 'any')
#1 C:\xampp\htdocs\gol\core\accesscontrol\classes\Access\Control.php(15): Route::url('login')
#2 C:\xampp\htdocs\gol\core\accesscontrol\classes\Kohana\Access\Control.php(24): Access_Control->getFirewalls()
#3 C:\xampp\htdocs\gol\frontend\application\config\accesscontrol.php(10): Kohana_Access_Control::instance()
#4 C:\xampp\htdocs\gol\frontend\application\bootstrap.php(146): require('C:\\xampp\\htdocs...')
#5 C:\xampp\htdocs\gol\frontend\index.php(105): require('C:\\xampp\\htdocs...')
#6 {main} in C:\xampp\htdocs\gol\core\system\classes\Route.php:133
2017-02-01 09:36:36 --- CRITICAL: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'api' at 'C:\xampp\htdocs\gol\core\api' ~ SYSPATH\classes\Kohana\Core.php [ 579 ] in C:\xampp\htdocs\gol\frontend\application\bootstrap.php:144
2017-02-01 09:36:36 --- DEBUG: #0 C:\xampp\htdocs\gol\frontend\application\bootstrap.php(144): Kohana_Core::modules(Array)
#1 C:\xampp\htdocs\gol\frontend\index.php(105): require('C:\\xampp\\htdocs...')
#2 {main} in C:\xampp\htdocs\gol\frontend\application\bootstrap.php:144
2017-02-01 09:36:59 --- CRITICAL: ErrorException [ 8 ]: Undefined index: x-nonce ~ C:\xampp\htdocs\gol\core\restful\classes\Kohana\Restful\Auth.php [ 124 ] in C:\xampp\htdocs\gol\core\restful\classes\Kohana\Restful\Auth.php:124
2017-02-01 09:36:59 --- DEBUG: #0 C:\xampp\htdocs\gol\core\restful\classes\Kohana\Restful\Auth.php(124): Kohana_Core::error_handler(8, 'Undefined index...', 'C:\\xampp\\htdocs...', 124, Array)
#1 C:\xampp\htdocs\gol\core\restful\classes\Kohana\Restful\Auth.php(70): Kohana_Restful_Auth->validate()
#2 C:\xampp\htdocs\gol\core\restful\classes\Kohana\Controller\Restful.php(49): Kohana_Restful_Auth->__construct('hash', 2, Array)
#3 C:\xampp\htdocs\gol\core\system\classes\Controller.php(8): Kohana_Controller_Restful->before()
#4 [internal function]: Controller->execute()
#5 C:\xampp\htdocs\gol\core\system\classes\Kohana\Request\Client\Internal.php(97): ReflectionMethod->invoke(Object(Controller_Api_Gol))
#6 C:\xampp\htdocs\gol\core\system\classes\Kohana\Request\Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 C:\xampp\htdocs\gol\core\system\classes\Request.php(85): Kohana_Request_Client->execute(Object(Request))
#8 C:\xampp\htdocs\gol\frontend\index.php(121): Request->execute()
#9 {main} in C:\xampp\htdocs\gol\core\restful\classes\Kohana\Restful\Auth.php:124
2017-02-01 09:37:55 --- CRITICAL: ErrorException [ 8 ]: Undefined index: x-token ~ C:\xampp\htdocs\gol\core\restful\classes\Kohana\Restful\Auth.php [ 99 ] in C:\xampp\htdocs\gol\core\restful\classes\Kohana\Restful\Auth.php:99
2017-02-01 09:37:55 --- DEBUG: #0 C:\xampp\htdocs\gol\core\restful\classes\Kohana\Restful\Auth.php(99): Kohana_Core::error_handler(8, 'Undefined index...', 'C:\\xampp\\htdocs...', 99, Array)
#1 C:\xampp\htdocs\gol\core\restful\classes\Kohana\Restful\Auth.php(71): Kohana_Restful_Auth->checkUser()
#2 C:\xampp\htdocs\gol\core\restful\classes\Kohana\Controller\Restful.php(49): Kohana_Restful_Auth->__construct('hash', 2, Array)
#3 C:\xampp\htdocs\gol\core\system\classes\Controller.php(8): Kohana_Controller_Restful->before()
#4 [internal function]: Controller->execute()
#5 C:\xampp\htdocs\gol\core\system\classes\Kohana\Request\Client\Internal.php(97): ReflectionMethod->invoke(Object(Controller_Api_Gol))
#6 C:\xampp\htdocs\gol\core\system\classes\Kohana\Request\Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 C:\xampp\htdocs\gol\core\system\classes\Request.php(85): Kohana_Request_Client->execute(Object(Request))
#8 C:\xampp\htdocs\gol\frontend\index.php(121): Request->execute()
#9 {main} in C:\xampp\htdocs\gol\core\restful\classes\Kohana\Restful\Auth.php:99
2017-02-01 09:38:42 --- CRITICAL: ErrorException [ 8 ]: Undefined index: x-token ~ C:\xampp\htdocs\gol\core\restful\classes\Kohana\Restful\Auth.php [ 99 ] in C:\xampp\htdocs\gol\core\restful\classes\Kohana\Restful\Auth.php:99
2017-02-01 09:38:42 --- DEBUG: #0 C:\xampp\htdocs\gol\core\restful\classes\Kohana\Restful\Auth.php(99): Kohana_Core::error_handler(8, 'Undefined index...', 'C:\\xampp\\htdocs...', 99, Array)
#1 C:\xampp\htdocs\gol\core\restful\classes\Kohana\Restful\Auth.php(71): Kohana_Restful_Auth->checkUser()
#2 C:\xampp\htdocs\gol\core\restful\classes\Kohana\Controller\Restful.php(49): Kohana_Restful_Auth->__construct('hash', 2, Array)
#3 C:\xampp\htdocs\gol\frontend\modules\api\classes\Controller\Api\Gol.php(7): Kohana_Controller_Restful->before()
#4 C:\xampp\htdocs\gol\core\system\classes\Controller.php(8): Controller_Api_Gol->before()
#5 [internal function]: Controller->execute()
#6 C:\xampp\htdocs\gol\core\system\classes\Kohana\Request\Client\Internal.php(97): ReflectionMethod->invoke(Object(Controller_Api_Gol))
#7 C:\xampp\htdocs\gol\core\system\classes\Kohana\Request\Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#8 C:\xampp\htdocs\gol\core\system\classes\Request.php(85): Kohana_Request_Client->execute(Object(Request))
#9 C:\xampp\htdocs\gol\frontend\index.php(121): Request->execute()
#10 {main} in C:\xampp\htdocs\gol\core\restful\classes\Kohana\Restful\Auth.php:99
2017-02-01 09:39:31 --- CRITICAL: ErrorException [ 1 ]: Call to undefined method Profiler::save() ~ C:\xampp\htdocs\gol\core\restful\classes\Kohana\Controller\Restful.php [ 78 ] in :
2017-02-01 09:39:31 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2017-02-01 09:49:18 --- CRITICAL: ErrorException [ 1 ]: Class 'Gol_Board' not found ~ MODPATH\api\classes\Model\Api.php [ 7 ] in :
2017-02-01 09:49:18 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2017-02-01 09:49:52 --- CRITICAL: ErrorException [ 1 ]: Class 'Cell' not found ~ MODPATH\gol\classes\Kohana\Gol\Board.php [ 39 ] in :
2017-02-01 09:49:52 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2017-02-01 11:06:41 --- CRITICAL: ErrorException [ 8 ]: Undefined index: x-nonce ~ C:\xampp\htdocs\gol\core\restful\classes\Kohana\Restful\Auth.php [ 124 ] in C:\xampp\htdocs\gol\core\restful\classes\Kohana\Restful\Auth.php:124
2017-02-01 11:06:41 --- DEBUG: #0 C:\xampp\htdocs\gol\core\restful\classes\Kohana\Restful\Auth.php(124): Kohana_Core::error_handler(8, 'Undefined index...', 'C:\\xampp\\htdocs...', 124, Array)
#1 C:\xampp\htdocs\gol\core\restful\classes\Kohana\Restful\Auth.php(70): Kohana_Restful_Auth->validate()
#2 C:\xampp\htdocs\gol\core\restful\classes\Kohana\Controller\Restful.php(42): Kohana_Restful_Auth->__construct('hash', 0, Array)
#3 C:\xampp\htdocs\gol\frontend\modules\api\classes\Controller\Api\Gol.php(9): Kohana_Controller_Restful->before()
#4 C:\xampp\htdocs\gol\core\system\classes\Controller.php(8): Controller_Api_Gol->before()
#5 [internal function]: Controller->execute()
#6 C:\xampp\htdocs\gol\core\system\classes\Kohana\Request\Client\Internal.php(97): ReflectionMethod->invoke(Object(Controller_Api_Gol))
#7 C:\xampp\htdocs\gol\core\system\classes\Kohana\Request\Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#8 C:\xampp\htdocs\gol\core\system\classes\Request.php(85): Kohana_Request_Client->execute(Object(Request))
#9 C:\xampp\htdocs\gol\frontend\index.php(121): Request->execute()
#10 {main} in C:\xampp\htdocs\gol\core\restful\classes\Kohana\Restful\Auth.php:124
2017-02-01 12:28:00 --- CRITICAL: Twig_Error_Loader [ 0 ]: Unable to find template "Main/ajax.twig" (looked into: C:\xampp\htdocs\gol\frontend\application\views, C:\xampp\htdocs\gol\core\minion\views, C:\xampp\htdocs\gol\core\orm\views, C:\xampp\htdocs\gol\core\jshelper\views, C:\xampp\htdocs\gol\core\files\views, C:\xampp\htdocs\gol\core\formbuilder\views, C:\xampp\htdocs\gol\core\pager\views, C:\xampp\htdocs\gol\core\helpers\views). ~ C:\xampp\htdocs\gol\core\twig\vendor\Twig\twig\lib\Twig\Loader\Filesystem.php [ 232 ] in C:\xampp\htdocs\gol\core\twig\vendor\Twig\twig\lib\Twig\Loader\Filesystem.php:150
2017-02-01 12:28:00 --- DEBUG: #0 C:\xampp\htdocs\gol\core\twig\vendor\Twig\twig\lib\Twig\Loader\Filesystem.php(150): Twig_Loader_Filesystem->findTemplate('Main/ajax.twig')
#1 C:\xampp\htdocs\gol\core\twig\vendor\Twig\twig\lib\Twig\Environment.php(329): Twig_Loader_Filesystem->getCacheKey('Main/ajax.twig')
#2 C:\xampp\htdocs\gol\core\twig\vendor\Twig\twig\lib\Twig\Environment.php(418): Twig_Environment->getTemplateClass('Main/ajax.twig', NULL)
#3 C:\xampp\htdocs\gol\core\twig\classes\Controller\Twig.php(58): Twig_Environment->loadTemplate('Main/ajax.twig')
#4 C:\xampp\htdocs\gol\frontend\application\classes\Controller\DefaultTemplate.php(96): Controller_Twig->after()
#5 C:\xampp\htdocs\gol\core\system\classes\Controller.php(28): Controller_DefaultTemplate->after()
#6 [internal function]: Controller->execute()
#7 C:\xampp\htdocs\gol\core\system\classes\Kohana\Request\Client\Internal.php(97): ReflectionMethod->invoke(Object(Controller_Main))
#8 C:\xampp\htdocs\gol\core\system\classes\Kohana\Request\Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#9 C:\xampp\htdocs\gol\core\system\classes\Request.php(85): Kohana_Request_Client->execute(Object(Request))
#10 C:\xampp\htdocs\gol\frontend\index.php(121): Request->execute()
#11 {main} in C:\xampp\htdocs\gol\core\twig\vendor\Twig\twig\lib\Twig\Loader\Filesystem.php:150
2017-02-01 12:55:09 --- CRITICAL: Database_Exception [ 1054 ]: Unknown column 'CONCAT_WS("-",boal_x,boal_y)' in 'field list' [ SELECT `CONCAT_WS("-",boal_x,boal_y)` AS `alives` FROM `board_alives` WHERE `boal_bo_id` = '2' ] ~ C:\xampp\htdocs\gol\core\mysqli\classes\Database\MySQLi.php [ 175 ] in C:\xampp\htdocs\gol\core\database\classes\Kohana\Database\Query.php:251
2017-02-01 12:55:09 --- DEBUG: #0 C:\xampp\htdocs\gol\core\database\classes\Kohana\Database\Query.php(251): Database_MySQLi->query(1, 'SELECT `CONCAT_...', false, Array)
#1 C:\xampp\htdocs\gol\frontend\application\classes\Model\Board.php(78): Kohana_Database_Query->execute()
#2 C:\xampp\htdocs\gol\frontend\application\classes\Model\Board.php(67): Model_Board->getAlives()
#3 C:\xampp\htdocs\gol\frontend\application\classes\Controller\Main.php(42): Model_Board->loadBoard('2')
#4 [internal function]: Controller_Main->action_ajax()
#5 C:\xampp\htdocs\gol\core\system\classes\Controller.php(25): call_user_func_array(Array, Array)
#6 [internal function]: Controller->execute()
#7 C:\xampp\htdocs\gol\core\system\classes\Kohana\Request\Client\Internal.php(97): ReflectionMethod->invoke(Object(Controller_Main))
#8 C:\xampp\htdocs\gol\core\system\classes\Kohana\Request\Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#9 C:\xampp\htdocs\gol\core\system\classes\Request.php(85): Kohana_Request_Client->execute(Object(Request))
#10 C:\xampp\htdocs\gol\frontend\index.php(121): Request->execute()
#11 {main} in C:\xampp\htdocs\gol\core\database\classes\Kohana\Database\Query.php:251