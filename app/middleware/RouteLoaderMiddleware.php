<?php namespace Belsrc\Boilerplate\Middleware;

class RouteLoaderMiddleware extends \Slim\Middleware {

    /**
     * Initializes a new instance of the this ConditionalLoadMiddleware class.
     */
    public function __construct() { }

    /**
     * The call method for this middleware.
     */
    public function call() {
        $app = $this->app;

        $app->hook('slim.before.router', function() use($app) {
            $routesPath = $app->paths['app'] . '/routes';

            $pattern = '@^/(\w+?).+$@';
            preg_match($pattern, $app->request()->getPathInfo(), $matches);

            if(!empty($matches) && file_exists($routesPath . $matches[0] . '.php')) {
                // Load only the matching route file
                require_once($routesPath . $matches[0] . '.php');
            }
            else {
                // Load all route files
                $files = array_diff(scandir($routesPath . '/'), array('..', '.'));
                foreach($files as $file) {
                    // We only want php files
                    $info = pathinfo($routesPath . '/' . $file);
                    if($info['extension'] === 'php') {
                        require_once($routesPath . '/' . $file);
                    }
                }
            }
        });

        $this->next->call();
    }
}
