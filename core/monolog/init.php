<?php
 spl_autoload_register(function($className) {
    if (substr($className, 0, 7) === 'Monolog') {
        $filename = str_replace('\\', DIRECTORY_SEPARATOR, trim($className, '\\')) . '.php';
        require_once $filename;
    }
});