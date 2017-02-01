<?php defined('SYSPATH') OR die('No direct script access.');

abstract class Controller extends Kohana_Controller {

	public function execute()
	{
		// Execute the "before action" method
		$this->before();

		// Determine the action to use
		$action = 'action_'.$this->request->action();

		// If the action doesn't exist, it's a 404
		if ( ! method_exists($this, $action))
		{
			throw HTTP_Exception::factory(404,
				'The requested URL :uri was not found on this server.',
				array(':uri' => $this->request->uri())
			)->request($this->request);
		}

		$params = $this->getMethodParams($action);

		// Execute the action itself
		call_user_func_array(array($this, $action), $params);

		// Execute the "after action" method
		$this->after();

		// Return the response
		return $this->response;
	}

	protected function getMethodParams($action)
	{
		$result = array();
		$method = new ReflectionMethod($this, $action);
		$params = $this->request->param();

		foreach ($method->getParameters() as $parameter) {
			if (array_key_exists($parameter->getName(),$params)) {
				$result[] = $this->assingVariable($parameter->getClass()->getName(),$params[$parameter->getName()]);
			}
		}

		return $result;
	}

	protected function assingVariable($class,$param)
	{
		if (strpos($class,'Model_') === false) return new $class($param);

		$requestLang = ORM::factory('Languages')->getRequestLang($this->request);
		$orm = ORM::factory(str_replace('Model_','',$class));

		$result = $orm->where($orm->getBinding(),'=',$param)->find($requestLang['lang']);
		if (!$result->loaded()) throw HTTP_Exception::factory(404,'The page not found!');

		return $result;
	}
}
