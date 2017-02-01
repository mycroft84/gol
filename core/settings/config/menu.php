<?php
/**
 * User: MyCroft
 * Date: 15-01-14
 * Time: 10:19
 * Company: d2c
 */

return array(
    'settings'=>array(
        'type'=>'main',
        'top'=>'settings',
        'icon'=>'',
        'position'=>1,
        'menu'=>array(
            array(
                'url'=>Route::i18nPath('settingsCreate'),
                'name'=>'create',
                'icon'=>'fa-plus',
                'roles'=>array('developer'),
            ),
            array(
                'url'=>Route::i18nPath('settingsList'),
                'name'=>'list',
                'icon'=>'fa-list'
            )
        )
    )
);