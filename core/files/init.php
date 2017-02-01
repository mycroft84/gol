<?php

/* Files route */
Route::set('fileDownload', 'download/files/<id>')
    ->defaults(array(
        'controller' => 'download',
        'action'     => 'files',
    ));

Route::set('filePreview', 'download/preview/<id>')
    ->defaults(array(
        'controller' => 'download',
        'action'     => 'preview',
    ));

Route::set('fileList', 'files/list/<table>/<id>')
    ->defaults(array(
        'controller' => 'files',
        'action'     => 'index',
    ));

Route::set('filesAjax', 'files/ajax/<actiontarget>(/<maintarget>(/<subtarget>))')
->defaults(array(
    'controller' => 'files',
    'action'=>'ajax'
));