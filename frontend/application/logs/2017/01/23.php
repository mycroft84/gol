<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2017-01-23 15:37:46 --- CRITICAL: Twig_Error_Syntax [ 0 ]: Unexpected "endif" tag (expecting closing tag for the "block" tag defined near line 4). ~ APPPATH\views\Emailtemplate\remember.twig [ 5 ] in C:\xampp\htdocs\enigma\core\twig\vendor\Twig\twig\lib\Twig\TokenParser\Block.php:40
2017-01-23 15:37:46 --- DEBUG: #0 C:\xampp\htdocs\enigma\core\twig\vendor\Twig\twig\lib\Twig\TokenParser\Block.php(40): Twig_Parser->subparse(Array, true)
#1 C:\xampp\htdocs\enigma\core\twig\vendor\Twig\twig\lib\Twig\Parser.php(190): Twig_TokenParser_Block->parse(Object(Twig_Token))
#2 C:\xampp\htdocs\enigma\core\twig\vendor\Twig\twig\lib\Twig\Parser.php(103): Twig_Parser->subparse(NULL, false)
#3 C:\xampp\htdocs\enigma\core\twig\vendor\Twig\twig\lib\Twig\Environment.php(692): Twig_Parser->parse(Object(Twig_TokenStream))
#4 C:\xampp\htdocs\enigma\core\twig\vendor\Twig\twig\lib\Twig\Environment.php(750): Twig_Environment->parse(Object(Twig_TokenStream))
#5 C:\xampp\htdocs\enigma\core\twig\vendor\Twig\twig\lib\Twig\Environment.php(447): Twig_Environment->compileSource(Object(Twig_Source))
#6 C:\xampp\htdocs\enigma\core\twig\classes\Twig.php(14): Twig_Environment->loadTemplate('Emailtemplate/r...')
#7 C:\xampp\htdocs\enigma\core\mailer\classes\Kohana\Mailer.php(69): Twig::get_template_content('Emailtemplate/r...', Array)
#8 C:\xampp\htdocs\enigma\frontend\application\classes\Model\User.php(165): Kohana_Mailer->setBody('remember', Array)
#9 C:\xampp\htdocs\enigma\frontend\application\classes\Controller\Test.php(13): Model_User->sendRememberEmail('valami')
#10 [internal function]: Controller_Test->action_index()
#11 C:\xampp\htdocs\enigma\core\system\classes\Controller.php(25): call_user_func_array(Array, Array)
#12 [internal function]: Controller->execute()
#13 C:\xampp\htdocs\enigma\core\system\classes\Kohana\Request\Client\Internal.php(97): ReflectionMethod->invoke(Object(Controller_Test))
#14 C:\xampp\htdocs\enigma\core\system\classes\Kohana\Request\Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#15 C:\xampp\htdocs\enigma\core\system\classes\Request.php(85): Kohana_Request_Client->execute(Object(Request))
#16 C:\xampp\htdocs\enigma\frontend\index.php(121): Request->execute()
#17 {main} in C:\xampp\htdocs\enigma\core\twig\vendor\Twig\twig\lib\Twig\TokenParser\Block.php:40