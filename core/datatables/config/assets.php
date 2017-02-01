<?php
/**
 * User: Tibor
 * Date: 2014.03.20.
 * Time: 19:29
 * Project: d2cadmin3.3
 * Company: d2c
 */

/**
 * AssetCollection initialize
 */
AssetCollection::instance()
    ->setCss('datatables',array('jquery.dataTables.css','component2.css'))
    ->setJs('datatables',array('jquery.dataTables.min.js','listview.js'),array('css'=>array('datatables'),'js'=>array('jquery')))
;