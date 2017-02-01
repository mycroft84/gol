<?php
/**
 * User: MyCroft
 * Date: 15-01-14
 * Time: 10:19
 * Company: d2c
 */

/**
 * AssetCollection initialize
 */
AssetCollection::instance()
    ->setJs('settingsCreate','sites/settings/create.js',array('js'=>array('forms')))
    ->setJs('settingsList','sites/settings/list.js',array('js'=>array('list')))
    ->setJs('settingsDetails','sites/settings/details.js',array('js'=>array('details')))
;

/**
 * AssetManager initialize
 */
AssetManager::instance()
    ->addController('settings')
        ->addAction('index')
            ->addJs(array('settingsList'))
        ->addAction('create')
            ->addJs(array('settingsCreate'))
        ->addAction('update')
            ->addJs(array('settingsCreate'))
        ->addAction('details')
           ->addJs(array('settingsDetails'))
;