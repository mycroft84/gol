<?php
/**
 * User: Tibi
 * Date: 2015.10.14.
 * Time: 11:37
 * Project: enigma
 * Company: d2c
 */
trait Traits_ORM_Logging
{
    protected $hasLogging = false;

    protected function logChanges($is_delete = false)
    {
        if ($this->hasLogging) {

            if ($is_delete) {

                Logging_Channels_Database::instance()->changes(
                    Logging_Channels_Database::DELETE,
                    $this->table_name(),
                    $this->_object,
                    array()
                );

            } else {

                Logging_Channels_Database::instance()->changes(
                    ($this->loaded()) ? Logging_Channels_Database::UPDATE : Logging_Channels_Database::CREATE,
                    $this->table_name(),
                    $this->_original_values,
                    $this->_object
                );

            }
        }
    }
}