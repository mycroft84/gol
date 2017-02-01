<?php
/**
 * User: MyCroft
 * Date: 2013.09.02.
 * Time: 8:31
 * Project: d2cadmin3.3
 * Company: d2c
 */
class Kohana_Access_Control 
{
    private $firewalls = array();
    private $access = array();

    private $_currentController = false;
    private $_currentAction = false;

    public static function instance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new Access_Control();
        }

        $inst->firewalls = $inst->getFirewalls();

        return $inst;
    }

    public function getFirewalls()
    {
        return array(
            'login'=>array(
                'login_path'=>false,
                'logout_path'=>false,
            )
        );
    }

    public function addDefaults(array $roles,array $exceptions)
    {
        if (!array_key_exists('defaults',$this->access)) $this->access['defaults'] = array();

        $access = array(
            'roles'=>$roles,
            'exception'=>$exceptions
        );

        $this->access['defaults'] = Arr::merge($this->access['defaults'],$access);
        return $this;
    }

    public function addController($name)
    {
        $name = strtolower($name);
        if (!array_key_exists($name,$this->access)) $this->access[$name] = array();
        $this->_currentController = $name;
        $this->_currentAction = false;

        return $this;
    }

    public function addAction($name)
    {
        if ($this->_currentController == false)
            throw new Exception("Controller not initialize!");
        else {
            $name = strtolower($name);
            if (!array_key_exists($name,$this->access[$this->_currentController])) $this->access[$this->_currentController][$name] = array();
            $this->_currentAction = $name;
        }

        return $this;
    }

    public function addAccess($roles, $exception = array())
    {
        if ($this->_currentController == false)
                    throw new Exception("Controller or Action not initialize!");

        $action = ($this->_currentAction) ? $this->_currentAction : '*';
        if (!array_key_exists($action,$this->access[$this->_currentController])) $this->access[$this->_currentController][$action] = array();

        if (!is_array($roles)) $roles = array($roles);
        if (!is_array($exception)) $exception = array($exception);

        $access = array(
            'roles'=>$roles,
            'exception'=>$exception
        );

        $this->access[$this->_currentController][$action] = Arr::merge($this->access[$this->_currentController][$action],$access);

        return $this;
    }

    public function check(Controller $controller, Auth $auth)
    {
        $currentAccess = $this->getCurrentAccess($controller);
        $check = $this->checkRoles($currentAccess,$auth);

        if (!$check['has']) {
            if (array_key_exists($check['role'],$this->firewalls)) {
                Session::instance()->set('errorLoginUrlError',true);
                Session::instance()->set('errorLoginUrl',$controller->request->detect_uri());

                $controller->redirect($this->firewalls[$check['role']]['login_url']);
            } else {
                throw new HTTP_Exception_403("Role is required: ".$check['role']);
            }
        }

        return true;
    }

    private function getCurrentAccess(Controller $controller)
    {
        $controllerName = strtolower($controller->request->controller());
        $actionName = strtolower($controller->request->action());

        $result = array();
        if (isset($this->access['defaults'])) $result = array_merge($result,$this->getCurrentRoles($this->access['defaults'],$controllerName,$actionName));

        if (isset($this->access[$controllerName]) and isset($this->access[$controllerName][$actionName])) $result = array_merge($result,$this->getCurrentRoles($this->access[$controllerName][$actionName],$controllerName,$actionName));
        if (isset($this->access[$controllerName]) and isset($this->access[$controllerName]['*'])) $result = array_merge($result,$this->getCurrentRoles($this->access[$controllerName]['*'],$controllerName,$actionName));

        return $result;
    }

    private function getCurrentRoles($roles,$controller,$action)
    {
        $result = array();
        if (!$this->isException($controller,$action,$roles['exception'])) {
            $result = $roles['roles'];
        }

        return $result;
    }

    private function checkRoles(array $roles, Auth $auth)
    {
        foreach($roles as $item)
        {
            if (!is_array($item)) {
                $current = $auth->hasRole(strtolower($item));
                if (!$current) return array('role'=>strtolower($item),'has'=>false);
            } else {
                $has = false;
                foreach ($item as $rItem) {
                    $current = $auth->hasRole(strtolower($rItem));
                    if ($current) $has = true;
                }
                if (!$has) return array('role'=>join(', ',$item),'has'=>false);
            }
        }

        return array('has'=>true);
    }

    private function isException($controller, $action, array $exception)
    {
        foreach ($exception as $item) {
            if (strpos($item,':') === false) {
                if (strtolower($item) == $controller) return true;
            } else {
                if (strtolower($item) == $controller.":".$action) return true;
            }
        }

        return false;
    }

}