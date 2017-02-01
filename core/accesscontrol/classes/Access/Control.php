<?php
/**
 * User: MyCroft
 * Date: 2013.09.02.
 * Time: 8:33
 * Project: d2cadmin3.3
 * Company: d2c
 */
class Access_Control extends Kohana_Access_Control {

    public function getFirewalls()
    {
        return array(
            'login'=>array(
                'login_url'=>Route::url('login'),
                'logout_url'=>Route::url('logout'),
            )
        );
    }

}