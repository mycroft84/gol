<?php
/**
 * User: MyCroft
 * Date: 2013.05.07.
 * Time: 15:11
 */

Route::set('logout', 'kilepes')
    ->defaults(array(
        'controller' => 'main',
        'action'     => 'logout',
    ));

Route::set('login', 'belepes')
    ->defaults(array(
        'controller' => 'main',
        'action'     => 'login',
    ));

Route::set('mainAjax', 'main/ajax/<actiontarget>(/<maintarget>(/<subtarget>))')
    ->defaults(array(
        'controller' => 'main',
        'action'=>'ajax'
    ));

/* Error route */
Route::set('error', 'error(/<action>(/<message>))', array('action' => '[0-9]++', 'message' => '.+'))
    ->defaults(array(
        'controller' => 'errorhandler',
        'action'=>'index'
    ));

/**
*Feed
*/
Route::set('feed', 'feed(/<slug>)')
    ->defaults(array(
        'controller' => 'feed',
        'action'     => 'index',
    ));

/**
 * Default routes (shoud be remove)
 */
Route::set('default', '')
    ->defaults(array(
        'controller' => 'main',
        'action'     => 'index',
    ));