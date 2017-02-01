<?php defined('SYSPATH') or die('No direct script access.');

$data = ORM::factory('settings')->find_all();
//backenden: php index.php --task=assets:pics:size:export
$picWidth = @include "pic_width.php";

$settings_data = array();

foreach($data as $item)
{
   $temp = json_decode($item->set_value,true);
   $settings_data[$item->set_name] = ($temp !== null) ? $temp : $item->set_value;
}

$settings_data['userfilesRealPath'] = realpath(APPPATH.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."userfiles");
$settings_data['userfilesUrl'] = URL::base(null,false)."userfiles/";
$settings_data['routeLangs'] = $settings_data['frontendLangs'];

$settings_data['forceLang'] = "";

if (is_array($picWidth)) {
    $settings_data = array_merge($settings_data,$picWidth);
}

return $settings_data;
