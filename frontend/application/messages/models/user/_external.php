<?php defined('SYSPATH') or die('No direct script access.');

return array(
    'password' => array(
        'not_empty' => 'A jelszó nem lehet üres.',
        'min_length' => 'A jelszó minimum :param2 karakterből kell állnia!'
    ),
    'password_confirm' => array(
        'matches' => 'A megadott két jelszó nem egyezik!'
    )
);