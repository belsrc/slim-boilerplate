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
            $reqPath = $app->request()->getPathInfo();
            preg_match($pattern, $reqPath, $matches);

            // If it is the base route load the base.php file
            if($reqPath === '/' && file_exists($routesPath . 'base.php')) {
                require_once($routesPath . 'base.php');
                return;
            }

            // If theres a route file that matches the section, load that
            if(!empty($matches) && file_exists($routesPath . $matches[0] . '.php')) {
                // Load only the matching route file
                require_once($routesPath . $matches[0] . '.php');
                return;
            }

            // Load all route files
            $files = array_diff(scandir($routesPath . '/'), array('..', '.'));
            foreach($files as $file) {
                // We only want php files
                $info = pathinfo($routesPath . '/' . $file);
                if($info['extension'] === 'php') {
                    require_once($routesPath . '/' . $file);
                }
            }
        });

        $this->next->call();
    }
}
