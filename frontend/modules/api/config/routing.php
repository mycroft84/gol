<?php

Route::post('getNextState', 'api/getNextStep')
    ->defaults(array(
        'controller' => 'Api_Gol',
        'action'=>'next'
    ));