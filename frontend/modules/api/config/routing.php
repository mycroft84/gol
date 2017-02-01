<?php

Route::post('getNextState', 'api/getNextStep')
    ->defaults(array(
        'controller' => 'Api_Gol',
        'action'=>'next'
    ));

Route::query('getBoards', 'api/getBoards')
    ->defaults(array(
        'controller' => 'Api_Gol',
        'action'=>'getBoards'
    ));

Route::query('getLoadBoard', 'api/getLoadBoard')
    ->defaults(array(
        'controller' => 'Api_Gol',
        'action'=>'getLoadBoard'
    ));