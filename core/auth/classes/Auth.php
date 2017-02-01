<?php defined('SYSPATH') OR die('No direct access allowed.');

abstract class Auth extends Kohana_Auth {

    protected $role_cache = array();

    private $is_developer = null;

    public function hasRole($role,$user = null)
    {
        if ($role == "login") {
            return $this->logged_in($role);
        }

        if ($user === null) {
            if ($this->is_developer === null and $this->logged_in()) $this->isDeveloper($user);

            if (!$this->is_developer){
                $roles = (empty($this->role_cache)) ? $this->getAllRoles($user) : $this->role_cache;
                $this->role_cache = $roles;

                return in_array($role,$roles);
            }
        } else {
            $roles = $this->getAllRoles($user);
            return in_array($role,$roles);

        }

        return true;
    }

    private function getAllRoles($user)
    {
        $result = array();
        if ($user === null) $user = $this->get_user();

        if ($this->logged_in()) {
            $roles = $user->roles->find_all();
            foreach($roles as $item)
            {
                $result[] = $item->name;
            }

            try{
                $groups = $user->groups->find_all();
                foreach ($groups as $group) {
                    foreach ($group->roles->find_all() as $item) {
                        if (!in_array($item->name,$result)) {
                            $result[] = $item->name;
                        }
                    }
                }
            } catch (Exception $e){}

            $result = array_merge($result,$this->getExtendedRights($user));
        }

        return $result;
    }

    private function isDeveloper($user)
    {
        $developer = $this->is_developer = false;
        if ($user === null) $user = $this->get_user();

        $roles = $user->roles->where('name','=','developer')->find();
        if ($roles->loaded()) {
            $this->is_developer = true;
            return true;
        }

        try{
            $groups = $user->groups->find_all();
            foreach ($groups as $group) {
                 $role = $group->roles->where('name','=','developer')->find();
                if ($role->loaded()) {
                    $this->is_developer = true;
                    return true;
                }
            }
        } catch (Exception $e){}

        $this->is_developer = $developer;
        return $developer;
    }

    public function changeUser($username)
    {
        $user = ORM::factory('user',array('username'=>$username));

        if ($user->loaded()) {
            Session::instance()->set('oldUser',Auth::instance()->get_user());
            Session::instance()->set($this->_config['session_key'],$user);
        }
    }

    public function changeBack()
    {
        $oldUser = Session::instance()->get('oldUser');
        Session::instance()->set($this->_config['session_key'],$oldUser);
    }

    private function getExtendedRights($user)
    {
        if ($user === null) $user = $this->get_user();

        $result = array();
        return $result;
    }

    public function loginWithEmail($email, $password)
    {
        $user = ORM::factory('User',array(
            'email'=>$email,
            'password'=>Auth::instance()->hash($password)
        ));
        if (!$user->loaded()) {
            return false;
        }

        $login = $user->roles->where('name','=','login')->find();
        if (!$login->loaded()) {
            return false;
        }

        Auth_ORM::instance()->force_login($user);
        return true;
    }
}