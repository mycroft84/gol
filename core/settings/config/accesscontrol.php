<?php
/**
 * User: MyCroft
 * Date: 2013.09.02.
 * Time: 14:49
 * Project: d2cadmin3.3
 * Company: d2c
 */
Access_Control::instance()
    ->addController('settings')
            ->addAccess(array('admin'))
        ->addAction('create')
            ->addAccess(array('developer'))
;