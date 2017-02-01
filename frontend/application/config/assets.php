<?php
/**
 * Default AssetCollection and AssetManager
 * User: MyCroft
 * Date: 2013.05.07.
 * Time: 15:14
 * To change this template use File | Settings | File Templates.
 */


/**
 * AssetCollection initialize
 */
AssetCollection::instance()
    ->setJs('default',array(
        'jquery-2.1.3.min.js',
        'bootstrap.min.js',
        'jquery.form.js',
        'twig.min.js',
        'twig.config.js',
        'sites/default.js'
    ))
    ->setJs('routingJs',URL::base(null,true).'js/routing')

    ->setCss('default',array(
        'bootstrap.css',
        'default.css',
    ))
;

/**
 * AssetManager initialize
 */
AssetManager::instance()
    ->defaultCss(array('default'))
    ->defaultJs(array('routingJs','default'))
;