<?php

/**
 * Weaver Framework - Router Class
 *
 * This class is responsible for routing requests to the appropriate controllers and actions.
 */

class Router
{
    /**
     * Associative array to store the registered routes.
     *
     * @var array
     */
    private $routes = [];

    /**
     * Add a new route to the router.
     *
     * @param string $route   The URL route to match.
     * @param string $handler The controller and action to execute (e.g., "HomeController@index").
     */
    public function addRoute($route, $handler)
    {
        $this->routes[$route] = $handler;
    }

    /**
     * Dispatch the request to the appropriate controller and action.
     *
     * @return void
     */
    public function dispatch()
    {
        // Get the URL path
        $url = isset($_GET['url']) ? $_GET['url'] : '/';
        // Route request
        try {
            $this->routeRequest($url);
        } catch (Exception_ $e) {
            System::displayErrorPage($e);
        }
    }

    /**
     * Route the request to the appropriate controller and action.
     *
     * @param string $url The requested URL.
     * @return void
     */
    private function routeRequest($url)
    {
        try {
            // Remove trailing slashes
            if ($url !== '/') {
                $url = rtrim($url, '/');
            }

            // Check if the route exists
            if (isset($this->routes[$url])) {
                $parts = explode('@', $this->routes[$url]);
                $controllerName = $parts[0];
                $actionName = $parts[1];

                // Ensure that the controller class exists
                if (class_exists($controllerName)) {
                    $controller = new $controllerName();

                    // Ensure that the action method exists in the controller
                    if (method_exists($controller, $actionName)) {
                        // Call the action method
                        $controller->$actionName();
                    } else {
                        throw new Exception_("#Router: Action method not found.");
                    }
                } else {
                    throw new Exception_("#Router: Controller class not found.");
                }
            } else {
                // Route not found
                throw new Exception_("#Router: Route not found.");
            }
        } catch (Exception_ $e) {
            System::displayErrorPage($e);
        }
    }

    /**
     * Display a 404 error page when the route is not found.
     *
     * @return void
     */
    private function show404Error()
    {
        header("HTTP/1.0 404 Not Found");
        require_once "Views/Error/404.php";
    }
}
