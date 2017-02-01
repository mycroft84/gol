<?php defined('SYSPATH') OR die('No direct script access.');

class Request extends Kohana_Request {

    public static function process(Request $request, $routes = NULL)
    {
        //Create i18n routes
        Route::createI18nRoutes();

        // Load routes
        $any_routes = Route::getRoutes('any');
        $request_routes = Route::getRoutes(strtolower($request->method()));

        $routes = Arr::merge($any_routes,$request_routes);
        $params = NULL;

        foreach ($routes as $name => $route)
        {
            // We found something suitable
            if ($params = $route->matches($request))
            {
                return array(
                    'params' => $params,
                    'route' => $route,
                );
            }
        }

        return NULL;
    }

	public function execute()
	{
		if ( ! $this->_external)
		{
			$processed = Request::process($this, $this->_routes);

			if ($processed)
			{
				// Store the matching route
				$this->_route = $processed['route'];
				$params = $processed['params'];

				// Is this route external?
				$this->_external = $this->_route->is_external();

				if (isset($params['directory']))
				{
					// Controllers are in a sub-directory
					$this->_directory = $params['directory'];
				}

				// Store the controller
				$this->_controller = $params['controller'];

				// Store the action
				$this->_action = (isset($params['action']))
					? $params['action']
					: Route::$default_action;

				// These are accessible as public vars and can be overloaded
				unset($params['controller'], $params['action'], $params['directory']);

				// Params cannot be changed once matched
				$this->_params = $params;
			}

		}

		if ( ! $this->_route instanceof Route)
		{
			return HTTP_Exception::factory(404, 'Unable to find a route to match the URI: :uri', array(
				':uri' => $this->_uri,
			))->request($this)
				->get_response();
		}

		if ( ! $this->_client instanceof Request_Client)
		{
			throw new Request_Exception('Unable to execute :uri without a Kohana_Request_Client', array(
				':uri' => $this->_uri,
			));
		}

		return $this->_client->execute($this);
	}

}
