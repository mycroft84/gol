<?php
/**
 * User: MyCroft
 * Date: 17-02-01
 * Time: 12:34
 * Company: d2c
 */

namespace PHPSTORM_META {
    $STATIC_METHOD_TYPES = [
        \Kohana_Model::factory('') => [
            'Board_Alives' instanceof \Model_Board_Alives,
            'Board' instanceof \Model_Board,
            'Languages' instanceof \Model_Languages,
            'Metadata' instanceof \Model_Metadata,
            'Settings' instanceof \Model_Settings,
            'Staticpage' instanceof \Model_Staticpage,
            'Auth_Role' instanceof \Model_Auth_Role,
            'Auth_User_Token' instanceof \Model_Auth_User_Token,
            'Auth_User' instanceof \Model_Auth_User,
            'Files_Types' instanceof \Model_Files_Types,
            'Files' instanceof \Model_Files,
            'Database' instanceof \Model_Database,
            'Jshelper' instanceof \Model_Jshelper,
            'Download' instanceof \Model_Download,
            'Api' instanceof \Model_Api,
        ],
    ];
}