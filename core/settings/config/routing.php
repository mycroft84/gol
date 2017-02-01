<?php
/**
 * User: MyCroft
 * Date: 15-01-14
 * Time: 10:19
 * Company: d2c
 */

Route::set('settingsAjax', 'settings/ajax/<actiontarget>(/<maintarget>(/<subtarget>))')
    ->defaults(array(
        'controller' => 'settings',
        'action'=>'ajax'
    ));

Route::set('settingsUpdate', 'settings/update/<slug>')
    ->defaults(array(
        'controller' => 'settings',
        'action'=>'update'
    ));

Route::set('settingsList', 'settings')
    ->defaults(array(
        'controller' => 'settings',
        'action'=>'index'
    ));
	
Route::set('settingsCreate', 'settings/create(/<slug>)')
    ->defaults(array(
        'controller' => 'settings',
        'action'=>'create'
    ));

Route::set('settingsDetails', 'settings/details/<slug>')
    ->defaults(array(
        'controller' => 'settings',
        'action'=>'details'
    ));