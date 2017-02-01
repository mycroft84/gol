<?php
/**
 * User: MyCroft
 * Date: 15-01-07
 * Time: 13:44
 * Company: d2c
 */

/**
 * AssetCollection initialize
 */
AssetCollection::instance()
    ->setJs('metadataCreate','sites/metadata/create.js',array('js'=>array('forms')))
    ->setJs('metadataList','sites/metadata/list.js',array('js'=>array('list')))
    ->setJs('metadataDetails','sites/metadata/details.js',array('js'=>array('details')))
;

/**
 * AssetManager initialize
 */
AssetManager::instance()
    ->addController('metadata')
        ->addAction('index')
            ->addJs(array('metadataList'))
        ->addAction('create')
            ->addJs(array('metadataCreate'))
        ->addAction('update')
            ->addJs(array('metadataCreate'))
        ->addAction('details')
           ->addJs(array('metadataDetails'))
;