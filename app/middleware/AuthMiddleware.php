<?php namespace Belsrc\Boilerplate\Middleware;

class AuthMiddleware extends \Slim\Middleware {

    private $_routes;
    private $_cookie;
    private $_redirect;

    /**
     * Initializes a new instance of the this AuthMiddleware class.
     * @param mixed  $routes   The route(s) that need authentication.
     * @param string $cookie   The auth cookie name to look for.
     * @param string $redirect The page to redirect to if not authorized.
     */
    public function __construct($routes, $cookie, $redirect) {
        $this->_routes = $routes;
        $this->_cookie = $cookie;
        $this->_redirect = $redirect;
    }

    /**
     * The call method for this middleware.
     */
    public function call() {
        $app = $this->app;
        $env = $app->appConfig['environment'];
        $routes = $this->_routes;
        $cookie = $this->_cookie;
        $redirect = $this->_redirect;
        $contains = function($base, $value) {
            foreach((array)$value as $v) {
                if(!empty($v) && strpos($base, $v) !== false ) {
                    return true;
                }
            }

            return false;
        };

        $app->hook('slim.before.router', function() use($app, $env, $contains, $routes, $cookie, $redirect) {
            if($contains($app->request()->getPathInfo(), $routes)) {
                if($env === 'production') {
                    if(!isset($_COOKIE[$cookie])) {
                        session_start();
                        $_SESSION['prev_url'] = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                        header("Location: $redirect");
                        die();
                    }
                }
            }
        });

        $this->next->call();
    }
}
