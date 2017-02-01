<?php defined('SYSPATH') OR die('No direct access allowed.');

return array(

	'driver'       => 'ORM',
	'hash_method'  => 'sha256',
	'hash_key'     => '5a1ac705b86af8060fa095934a31dc83f67a431f0db471376217d7dd7905ae73d1fdec41b96c8d07e079f7cf95f82930de75c6ddf976704ae8e37c4b4bf351e0',
	'lifetime'     => 1209600,
	'session_type' => Session::$default,
	'session_key'  => 'auth_user',

	// Username/password combinations for the Auth File driver
	'users' => array(
		// 'admin' => 'b3154acf3a344170077d11bdb5fff31532f679a1919e716a02',
	),

);
