<?php
/**
 * User: MyCroft
 * Company: design2code.hu
 * Product: d2cadmin
 * Date: 2013.05.11.
 * Time: 10:56
 */

Route::set('jsRouting', 'js/routing')
    ->defaults(array(
        'controller' => 'jshelper',
        'action'     => 'routing',
    ));

Route::set('jsSettings', 'js/settings')
    ->defaults(array(
        'controller' => 'jshelper',
        'action'     => 'settings',
    ));

Route::set('jsHelper', 'js/helper')
    ->defaults(array(
        'controller' => 'jshelper',
        'action'     => 'helper',
    ));

Route::set('jsI18n', 'js/i18n/<slug>')
    ->defaults(array(
        'controller' => 'jshelper',
        'action'     => 'i18n',
    ));