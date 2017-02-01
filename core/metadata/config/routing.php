<?php
/**
 * User: MyCroft
 * Date: 15-01-07
 * Time: 13:44
 * Company: d2c
 */

Route::set('metadataAjax', 'metadata/ajax/<actiontarget>(/<maintarget>(/<subtarget>))')
    ->defaults(array(
        'controller' => 'metadata',
        'action'=>'ajax'
    ));

Route::set('metadataUpdate', 'metadata/update/<slug>')
    ->defaults(array(
        'controller' => 'metadata',
        'action'=>'update'
    ));

Route::set('metadataList', 'metadata')
    ->defaults(array(
        'controller' => 'metadata',
        'action'=>'index'
    ));
	
Route::set('metadataCreate', 'metadata/create(/<slug>)')
    ->defaults(array(
        'controller' => 'metadata',
        'action'=>'create'
    ));

Route::set('metadataDetails', 'metadata/details/<slug>')
    ->defaults(array(
        'controller' => 'metadata',
        'action'=>'details'
    ));