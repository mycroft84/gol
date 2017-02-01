<?php defined('SYSPATH') OR die('No direct script access.');

class Route extends Kohana_Route {

    static function uris()
    {
        $result = array();
        foreach(self::$_routes as $type=>$routes)
        {
            foreach($routes as $index=>$value) {
                $currentUri = str_replace(array("(", ")"), array("", ""), $value->_uri);

                $result[$type][$index] = explode('/', $currentUri);
            }
        }

        return $result;
    }

    public static function hasRoute($name,$type = 'any')
    {
        return isset(Route::$_routes[$type][$name]);
    }

    public static function getUriControllersActions()
    {
        $result = array();
        foreach (self::$_routes as $item) {
            if (isset($item->_defaults['controller']) and isset($item->_defaults['action']))
            {
                if (!array_key_exists($item->_defaults['controller'],$result)) {
                    $result[$item->_defaults['controller']] = array();
                }

                $result[$item->_defaults['controller']][] = $item->_defaults['action'];
            }
        }

        return $result;
    }

    static function createI18nRoutes()
    {
        $langs = Kohana::$config->load('settings.frontendLangs');
        $langsPart = array_slice($langs,1);
        
        $allRoutes = Route::all();
        self::$_routes = array();

        foreach($allRoutes as $type=>$routes)
        {
            foreach ($routes as $name=>$route) {

                if (strpos($name, '_lang') !== false) continue;

                //adddefault Route
                $route->defaults(array_merge($route->_defaults, array('lang' => current($langs))));
                self::$_routes[$type][$name] = $route;

                //Skipp if not extends lang
                if (empty($langsPart)) continue;

                if ($route->_uri and $route->_uri[0] == "(") {
                    $delimiter = "(/";
                    $routeString = substr($route->_uri, 1);
                } else {
                    $delimiter = ($route->_uri) ? "/" : "";
                    $routeString = $route->_uri;
                }

                $regExp = $route->_regex;
                $regExp['lang'] = '(' . join("|", $langsPart) . ')';

                $langRoute = new Route('<lang>' . $delimiter . $routeString, $regExp);

                $langDefault = $route->_defaults;
                unset($langDefault['lang']);
                $langRoute->defaults($langDefault);
                foreach ($route->_filters as $filter) {
                    $langRoute->filter($filter);
                }

                self::$_routes[$type][$name . "_lang"] = $langRoute;

            }
        }
    }
	
	static function i18nPath($route_name,$uri = array())
    {
        $defaultLang = current(Kohana::$config->load('settings.routeLangs'));
        if ($defaultLang != I18n::$lang or Kohana::$config->load('settings.forceLang') != "") {
            $route_name = $route_name."_lang";
            $uri['lang'] = I18n::$lang;
        }

        $method = (array_key_exists('method',$uri)) ? $uri['method'] : 'any';
        $url = Route::get($route_name,$method);
        $url = (!empty($uri)) ? $url->uri($uri) : $url->uri();

        if (isset($_GET['env']) and $_GET['env'] == 'prod')
        {
            $url.= "?env=prod";
        }

        return $url;
    }

    static function i18nUrl($route_name,$uri = array())
    {
        $defaultLang = current(Kohana::$config->load('settings.routeLangs'));
        if ($defaultLang != I18n::$lang or Kohana::$config->load('settings.forceLang') != "") {
            $route_name = $route_name."_lang";
            $uri['lang'] = I18n::$lang;
        }

        if (empty($uri)) $uri = array();
        $method = (array_key_exists('method',$uri)) ? $uri['method'] : 'any';
        $url = Route::get($route_name,$method);
        $url = (!empty($uri)) ? $url->uri($uri) : $url->uri();

        if (isset($_GET['env']) and $_GET['env'] == 'prod')
        {
            $url.= "?env=prod";
        }

        return URL::base().$url;
    }

    public static function url($name, array $params = array(), $protocol = NULL)
    {
        $method = (array_key_exists('method',$params)) ? $params['method'] : 'any';
        $route = Route::get($name,$method);

        // Create a URI with the route and convert it to a URL
        if ($route->is_external())
            return Route::get($name)->uri($params);
        else
            return URL::site(Route::get($name)->uri($params), $protocol);
    }
	
	public static function getCurrentLangRoutes(Request $request)
    {
        $langs = Kohana::$config->load('settings.routeLangs');
        $routeParts = explode('/',$request->uri());
        $originalRoute = array();
        $result = array();

        foreach ($routeParts as $item) {
            if (!in_array($item,$langs)) {
                $originalRoute[] = $item;
            }
        }

        foreach ($langs as $index => $item) {
            if ($index) {
                $result[$item] = rtrim(Url::base().join('/',array_merge(array($item),$originalRoute)),'/');
            } else {
                $result[$item] = rtrim(Url::base().join('/',$originalRoute),'/');
            }
        }

        return $result;
    }
	
	public function uri(array $params = NULL)
    {
        // Start with the routed URI
        $uri = $this->_uri;

        if (strpos($uri, '<') === FALSE AND strpos($uri, '(') === FALSE)
        {
            // This is a static route, no need to replace anything

            if ( ! $this->is_external())
                return $uri;

            // If the localhost setting does not have a protocol
            if (strpos($this->_defaults['host'], '://') === FALSE)
            {
                // Use the default defined protocol
                $params['host'] = Route::$default_protocol.$this->_defaults['host'];
            }
            else
            {
                // Use the supplied host with protocol
                $params['host'] = $this->_defaults['host'];
            }

            // Compile the final uri and return it
            return rtrim($params['host'], '/').'/'.$uri;
        }

        // Keep track of whether an optional param was replaced
        $provided_optional = FALSE;

        while (preg_match('#\([^()]++\)#', $uri, $match))
        {

            // Search for the matched value
            $search = $match[0];

            // Remove the parenthesis from the match as the replace
            $replace = substr($match[0], 1, -1);

            while (preg_match('#'.Route::REGEX_KEY.'#', $replace, $match))
            {
                list($key, $param) = $match;

                if (isset($params[$param]) AND $params[$param] !== Arr::get($this->_defaults, $param))
                {
                    // Future optional params should be required
                    $provided_optional = TRUE;

                    // Replace the key with the parameter value
                    $replace = str_replace($key, $params[$param], $replace);
                }
                elseif ($provided_optional)
                {
                    // Look for a default
                    if (isset($this->_defaults[$param]))
                    {
                        $replace = str_replace($key, $this->_defaults[$param], $replace);
                    }
                    else
                    {
                        // Ungrouped parameters are required
                        throw new Kohana_Exception('Required route parameter not passed: :param (:routename)', array(
                            ':param' => $param,
                            ':routename'=>Route::name($this)
                        ));
                    }
                }
                else
                {
                    // This group has missing parameters
                    $replace = '';
                    break;
                }
            }

            // Replace the group in the URI
            $uri = str_replace($search, $replace, $uri);
        }

        while (preg_match('#'.Route::REGEX_KEY.'#', $uri, $match))
        {
            list($key, $param) = $match;

            if ( ! isset($params[$param]))
            {
                // Look for a default
                if (isset($this->_defaults[$param]))
                {
                    $params[$param] = $this->_defaults[$param];
                }
                else
                {
                    // Ungrouped parameters are required
                    throw new Kohana_Exception('Required route parameter not passed: :param (:routename)', array(
                        ':param' => $param,
                        ':routename'=>Route::name($this)
                    ));
                }
            }

            $uri = str_replace($key, $params[$param], $uri);
        }

        // Trim all extra slashes from the URI
        $uri = preg_replace('#//+#', '/', rtrim($uri, '/'));

        if ($this->is_external())
        {
            // Need to add the host to the URI
            $host = $this->_defaults['host'];

            if (strpos($host, '://') === FALSE)
            {
                // Use the default defined protocol
                $host = Route::$default_protocol.$host;
            }

            // Clean up the host and prepend it to the URI
            $uri = rtrim($host, '/').'/'.$uri;
        }

        return $uri;
    }

    public static function getRoutes($type = 'any')
    {
        return (isset(self::$_routes[$type])) ? self::$_routes[$type] : array();
    }

    public static function set($name, $uri = NULL, $regex = NULL)
    {
        return Route::$_routes['any'][$name] = new Route($uri, $regex);
    }

    public static function post($name, $uri = NULL, $regex = NULL)
    {
        return Route::$_routes['post'][$name] = new Route($uri, $regex);
    }

        public static function query($name, $uri = NULL, $regex = NULL)
    {
        return Route::$_routes['get'][$name] = new Route($uri, $regex);
    }

    public static function put($name, $uri = NULL, $regex = NULL)
    {
        return Route::$_routes['put'][$name] = new Route($uri, $regex);
    }

    public static function delete($name, $uri = NULL, $regex = NULL)
    {
        return Route::$_routes['delete'][$name] = new Route($uri, $regex);
    }
    
    public static function patch($name, $uri = NULL, $regex = NULL)
    {
        return Route::$_routes['patch'][$name] = new Route($uri, $regex);
    }

    public static function get($name,$method = 'any')
    {
        if ( ! isset(Route::$_routes[$method][$name]))
        {
            throw new Kohana_Exception('The requested route does not exist: :route',
                array(':route' => $name));
        }

        return Route::$_routes[$method][$name];
    }

}
