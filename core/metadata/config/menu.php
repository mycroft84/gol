<?php
/**
 * User: MyCroft
 * Date: 15-01-07
 * Time: 13:44
 * Company: d2c
 */

return array(
    'metadata'=>array(
        'type'=>'main',
        'top'=>'metadata',
        'icon'=>'fa-code',
        'position'=>19,
        'roles'=>array('developer'),
        'menu'=>array(
            array(
                'url'=>Route::i18nPath('metadataCreate'),
                'name'=>'create',
                'icon'=>'fa-plus'
            ),
            array(
                'url'=>Route::i18nPath('metadataList'),
                'name'=>'list',
                'icon'=>'fa-list'
            )
        )
    )
);