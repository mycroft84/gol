<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Interface that all minion tasks must implement
 */
abstract class Minion_Task extends Kohana_Minion_Task {

	protected function addPid($name)
	{
		$cron = realpath(APPPATH."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."cron");
		file_put_contents($cron.DIRECTORY_SEPARATOR.$name.'.pid',posix_getpid());
	}

	protected function removePid($name)
	{
		$cron = realpath(APPPATH."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."cron");
		unlink($cron.DIRECTORY_SEPARATOR.$name.'.pid');
	}

}
