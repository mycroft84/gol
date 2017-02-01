<?php
/**
 * User: MyCroft
 * Date: 2013.09.02.
 * Time: 8:35
 * Project: d2cadmin3.3
 * Company: d2c
 */
class Controller_Test extends Controller
{
    public function action_index()
    {
        ORM::factory('User',10)->sendRememberEmail('valami');
    }
}